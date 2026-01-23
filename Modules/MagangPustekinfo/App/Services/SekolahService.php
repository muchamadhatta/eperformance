<?php

namespace Modules\MagangPustekinfo\App\Services;

use Modules\MagangPustekinfo\App\Models\SekolahModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SekolahService
{
    protected $apiUrl;
    protected $apiKey;
    protected $sekolahModel;

    public function __construct(SekolahModel $sekolahModel)
    {
        $this->apiUrl = env('API_CO_ID_URL', 'https://use.api.co.id');
        $this->apiKey = env('API_CO_ID_KEY');
        $this->sekolahModel = $sekolahModel;
    }


    public function getAllSekolah($search = null, $grade = null, $provinceCode = null, $perPage = 10)
    {
        $query = $this->sekolahModel->where('is_active', 1);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('npsn', 'like', "%{$search}%")
                  ->orWhere('province_name', 'like', "%{$search}%")
                  ->orWhere('regency_name', 'like', "%{$search}%");
            });
        }
        
        if ($grade) {
            $query->where('grade', $grade);
        }
        
        if ($provinceCode) {
            $query->where('province_code', $provinceCode);
        }
        
        return $query->orderBy('name', 'asc')->paginate($perPage);
    }


    public function getSekolahById($id)
    {
        return $this->sekolahModel->findOrFail($id);
    }


    public function syncFromApi($provinceCode = '32', $maxPages = 100, $allowedGrades = ['SMA', 'SMK'])
    {
        set_time_limit(600); // 10 minutes
        
        $totalSynced = 0;
        $page = 1;
        $size = 100;
        
        Log::info("Starting sync for province: {$provinceCode}, grades: " . implode(',', $allowedGrades) . ", maxPages: {$maxPages}");
        
        while ($page <= $maxPages) {
            $response = $this->fetchFromApi($provinceCode, $page, $size);
            
            if (!isset($response['data']) || empty($response['data'])) {
                Log::info("No more data at page {$page} for province {$provinceCode}");
                break;
            }
            
            Log::info("Fetched " . count($response['data']) . " records from page {$page}");
            
            // Debug: Log unique grades in this batch
            $gradesInBatch = collect($response['data'])->pluck('grade')->unique()->toArray();
            Log::info("Grades in batch: " . json_encode($gradesInBatch));
            
            foreach ($response['data'] as $item) {
                $grade = $item['grade'] ?? null;
                
                // Filter: only sync allowed grades (SMA, SMK by default)
                if (!empty($allowedGrades) && !in_array($grade, $allowedGrades)) {
                    continue;
                }
                
                $this->sekolahModel->updateOrCreate(
                    ['npsn' => $item['npsn'] ?? null],
                    [
                        'name' => $item['name'] ?? '',
                        'grade' => $grade,
                        'status' => $item['status'] ?? null,
                        'address' => $item['address'] ?? null,
                        'province_code' => $item['province_code'] ?? $provinceCode,
                        'province_name' => $item['province_name'] ?? null,
                        'regency_code' => $item['regency_code'] ?? null,
                        'regency_name' => $item['regency_name'] ?? null,
                        'district_code' => $item['district_code'] ?? null,
                        'district_name' => $item['district_name'] ?? null,
                        'lang' => $item['lang'] ?? null,
                        'long' => $item['long'] ?? null,
                        'is_active' => 1,
                        'last_synced_at' => now(),
                    ]
                );
                $totalSynced++;
            }
            
            if (count($response['data']) < $size) {
                Log::info("Last page reached for province {$provinceCode}");
                break;
            }
            
            $page++;
        }
        
        Log::info("Sync completed for province {$provinceCode}. Total synced: {$totalSynced}");
        
        return $totalSynced;
    }


    public function getProvinces()
    {
        return [
            '11' => 'Aceh',
            '12' => 'Sumatera Utara',
            '13' => 'Sumatera Barat',
            '14' => 'Riau',
            '15' => 'Jambi',
            '16' => 'Sumatera Selatan',
            '17' => 'Bengkulu',
            '18' => 'Lampung',
            '19' => 'Bangka Belitung',
            '21' => 'Kepulauan Riau',
            '31' => 'DKI Jakarta',
            '32' => 'Jawa Barat',
            '33' => 'Jawa Tengah',
            '34' => 'DI Yogyakarta',
            '35' => 'Jawa Timur',
            '36' => 'Banten',
            '51' => 'Bali',
            '52' => 'Nusa Tenggara Barat',
            '53' => 'Nusa Tenggara Timur',
            '61' => 'Kalimantan Barat',
            '62' => 'Kalimantan Tengah',
            '63' => 'Kalimantan Selatan',
            '64' => 'Kalimantan Timur',
            '65' => 'Kalimantan Utara',
            '71' => 'Sulawesi Utara',
            '72' => 'Sulawesi Tengah',
            '73' => 'Sulawesi Selatan',
            '74' => 'Sulawesi Tenggara',
            '75' => 'Gorontalo',
            '76' => 'Sulawesi Barat',
            '81' => 'Maluku',
            '82' => 'Maluku Utara',
            '91' => 'Papua',
            '92' => 'Papua Barat',
        ];
    }


    protected function fetchFromApi($provinceCode, $page = 1, $size = 100)
    {
        try {
            $url = "{$this->apiUrl}/regional/indonesia/schools";
            
            $response = Http::timeout(30)->withHeaders([
                'x-api-co-id' => $this->apiKey,
            ])->get($url, [
                'province_code' => $provinceCode,
                'page' => $page,
                'size' => $size,
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to fetch schools from API', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return ['data' => []];
        } catch (\Exception $e) {
            Log::error('Error fetching schools from API', ['error' => $e->getMessage()]);
            return ['data' => []];
        }
    }


    public function getLastSyncTime()
    {
        $latest = $this->sekolahModel->whereNotNull('last_synced_at')
            ->orderBy('last_synced_at', 'desc')
            ->first();
        
        return $latest ? $latest->last_synced_at : null;
    }


    public function getTotalCount()
    {
        return $this->sekolahModel->where('is_active', 1)->count();
    }


    public function getGrades()
    {
        return $this->sekolahModel->where('is_active', 1)
            ->whereNotNull('grade')
            ->distinct()
            ->pluck('grade')
            ->toArray();
    }
}
