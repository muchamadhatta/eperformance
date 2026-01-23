<?php

namespace Modules\MagangPustekinfo\App\Services;

use Modules\MagangPustekinfo\App\Models\UniversitasModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UniversitasService
{
    protected $apiUrl;
    protected $apiKey;
    protected $universitasModel;

    public function __construct(UniversitasModel $universitasModel)
    {
        $this->apiUrl = env('API_CO_ID_URL', 'https://use.api.co.id');
        $this->apiKey = env('API_CO_ID_KEY');
        $this->universitasModel = $universitasModel;
    }


    public function getAllUniversitas($search = null, $perPage = 10)
    {
        $query = $this->universitasModel->where('is_active', 1);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('regency', 'like', "%{$search}%")
                  ->orWhere('university_type', 'like', "%{$search}%");
            });
        }
        
        return $query->orderBy('name', 'asc')->paginate($perPage);
    }


    public function getUniversitasById($id)
    {
        return $this->universitasModel->findOrFail($id);
    }


    public function syncFromApi()
    {
        $totalSynced = 0;
        $page = 1;
        $size = 100;
        $hasMore = true;
        
        while ($hasMore) {
            $response = $this->fetchFromApi($page, $size);
            
            if (!isset($response['data']) || empty($response['data'])) {
                $hasMore = false;
                break;
            }
            
            foreach ($response['data'] as $item) {
                $this->universitasModel->updateOrCreate(
                    [
                        'name' => $item['name'] ?? '', 
                        'province_code' => $item['province_code'] ?? null
                    ],
                    [
                        'short_name' => $item['short_name'] ?? null,
                        'group' => $item['group'] ?? null,
                        'university_type' => $item['university_type'] ?? null,
                        'address' => $item['address'] ?? null,
                        'province' => $item['province'] ?? null,
                        'province_code' => $item['province_code'] ?? null,
                        'regency' => $item['regency'] ?? null,
                        'regency_code' => $item['regency_code'] ?? null,
                        'lat' => $item['lat'] ?? null,
                        'long' => $item['long'] ?? null,
                        'is_active' => 1,
                        'last_synced_at' => now(),
                    ]
                );
                $totalSynced++;
            }
            
            if (count($response['data']) < $size) {
                $hasMore = false;
            }
            
            $page++;
            
            // Safety: max 50 pages (5000 universities)
            if ($page > 50) {
                $hasMore = false;
            }
        }
        
        return $totalSynced;
    }


    protected function fetchFromApi($page = 1, $size = 100)
    {
        try {
            $url = "{$this->apiUrl}/regional/indonesia/universities";
            
            $response = Http::withHeaders([
                'x-api-co-id' => $this->apiKey,
            ])->get($url, [
                'page' => $page,
                'size' => $size,
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to fetch universities from API', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return ['data' => []];
        } catch (\Exception $e) {
            Log::error('Error fetching universities from API', ['error' => $e->getMessage()]);
            return ['data' => []];
        }
    }


    public function getLastSyncTime()
    {
        $latest = $this->universitasModel->whereNotNull('last_synced_at')
            ->orderBy('last_synced_at', 'desc')
            ->first();
        
        return $latest ? $latest->last_synced_at : null;
    }


    public function getTotalCount()
    {
        return $this->universitasModel->where('is_active', 1)->count();
    }
}
