<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\SekolahService;
use Modules\MagangPustekinfo\App\Models\SekolahCustomModel;

class SekolahController extends Controller
{
    protected $sekolahService;

    public function __construct(SekolahService $sekolahService)
    {
        $this->sekolahService = $sekolahService;
    }


    public function index(Request $request)
    {
        $search = $request->get('search');
        $grade = $request->get('grade');
        $provinceCode = $request->get('province');
        $perPage = $request->get('per_page', 10);
        
        $sekolah = $this->sekolahService->getAllSekolah($search, $grade, $provinceCode, $perPage);
        $lastSync = $this->sekolahService->getLastSyncTime();
        $totalCount = $this->sekolahService->getTotalCount();
        $grades = $this->sekolahService->getGrades();
        $provinces = $this->sekolahService->getProvinces();
        
        return view('magangpustekinfo::admin.sekolah.index', [
            'sekolah' => $sekolah,
            'search' => $search,
            'grade' => $grade,
            'provinceCode' => $provinceCode,
            'perPage' => $perPage,
            'lastSync' => $lastSync,
            'totalCount' => $totalCount,
            'grades' => $grades,
            'provinces' => $provinces,
        ]);
    }


    public function sync(Request $request)
    {
        $provinceCode = $request->get('province', '32');
        $grades = $request->get('grades', ['SMA', 'SMK']);
        $provinces = $this->sekolahService->getProvinces();
        $provinceName = $provinces[$provinceCode] ?? 'Unknown';
        
        try {
            $totalSynced = $this->sekolahService->syncFromApi($provinceCode, 100, $grades);
            $gradeText = implode(', ', $grades);
            Alert::success('Berhasil', "Sinkronisasi {$provinceName} selesai! {$totalSynced} sekolah ({$gradeText}) disinkronkan.");
            return redirect()->route('magangpustekinfo.admin.sekolah.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage());
            return redirect()->route('magangpustekinfo.admin.sekolah.index');
        }
    }


    public function syncProvince(Request $request)
    {
        $provinceCode = $request->get('province');
        $grades = $request->get('grades', ['SMA', 'SMK']);
        if (is_string($grades)) {
            $grades = explode(',', $grades);
        }
        $provinces = $this->sekolahService->getProvinces();
        $provinceName = $provinces[$provinceCode] ?? 'Unknown';
        
        try {
            $totalSynced = $this->sekolahService->syncFromApi($provinceCode, 100, $grades);
            return response()->json([
                'success' => true,
                'province' => $provinceName,
                'province_code' => $provinceCode,
                'synced' => $totalSynced,
                'message' => "{$provinceName}: {$totalSynced} sekolah disinkronkan"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'province' => $provinceName,
                'province_code' => $provinceCode,
                'message' => "Error: " . $e->getMessage()
            ], 500);
        }
    }


    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $grade = $request->get('grade');
        $sekolah = $this->sekolahService->getAllSekolah($query, $grade, null, 20);
        
        $data = [];
        foreach ($sekolah as $item) {
            $data[] = [
                'id' => $item->name,
                'text' => $item->name . ($item->grade ? " ({$item->grade})" : ''),
            ];
        }
        
        // Include sekolah custom yang sudah ditambahkan user
        $customSekolah = SekolahCustomModel::where('name', 'like', '%' . $query . '%')
            ->orWhere('npsn', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();
        
        foreach ($customSekolah as $item) {
            $data[] = [
                'id' => $item->name,
                'text' => $item->name . ($item->grade ? " ({$item->grade})" : '') . ' (Custom)',
            ];
        }
        
        return response()->json([
            'results' => $data,
            'pagination' => [
                'more' => $sekolah->hasMorePages()
            ]
        ]);
    }


    // API endpoint untuk menyimpan sekolah custom dari user
    public function storeCustom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'grade' => 'nullable|in:SD,SMP,SMA,SMK',
            'status' => 'nullable|in:N,S',
            'address' => 'nullable|string',
            'province_name' => 'nullable|string|max:100',
            'regency_name' => 'nullable|string|max:100',
        ]);

        // Cek apakah sudah ada dengan nama yang sama
        $existing = SekolahCustomModel::where('name', $request->name)->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Data sudah ada',
                'data' => $existing,
            ]);
        }

        $custom = SekolahCustomModel::create([
            'name' => $request->name,
            'npsn' => $request->npsn,
            'grade' => $request->grade,
            'status' => $request->status,
            'address' => $request->address,
            'province_name' => $request->province_name,
            'regency_name' => $request->regency_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $custom,
        ]);
    }
}
