<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\UniversitasService;
use Modules\MagangPustekinfo\App\Models\UniversitasCustomModel;

class UniversitasController extends Controller
{
    protected $universitasService;

    public function __construct(UniversitasService $universitasService)
    {
        $this->universitasService = $universitasService;
    }


    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $universitas = $this->universitasService->getAllUniversitas($search, $perPage);
        $lastSync = $this->universitasService->getLastSyncTime();
        $totalCount = $this->universitasService->getTotalCount();
        
        return view('magangpustekinfo::admin.universitas.index', [
            'universitas' => $universitas,
            'search' => $search,
            'perPage' => $perPage,
            'lastSync' => $lastSync,
            'totalCount' => $totalCount,
        ]);
    }


    public function sync()
    {
        try {
            $totalSynced = $this->universitasService->syncFromApi();
            Alert::success('Berhasil', "Sinkronisasi selesai! {$totalSynced} universitas disinkronkan.");
            return redirect()->route('magangpustekinfo.admin.universitas.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat sinkronisasi: ' . $e->getMessage());
            return redirect()->route('magangpustekinfo.admin.universitas.index');
        }
    }


    // API endpoint for Select2 dropdown
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $universitas = $this->universitasService->getAllUniversitas($query, 20);
        
        $data = [];
        foreach ($universitas as $item) {
            $data[] = [
                'id' => $item->name,
                'text' => $item->name . ($item->short_name ? " ({$item->short_name})" : ''),
            ];
        }
        
        // Include universitas custom yang sudah ditambahkan user (langsung tersedia tanpa verifikasi)
        $customUniversitas = UniversitasCustomModel::where('name', 'like', '%' . $query . '%')
            ->orWhere('short_name', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();
        
        foreach ($customUniversitas as $item) {
            $data[] = [
                'id' => $item->name,
                'text' => $item->name . ($item->short_name ? " ({$item->short_name})" : '') . ' (Custom)',
            ];
        }
        
        return response()->json([
            'results' => $data,
            'pagination' => [
                'more' => $universitas->hasMorePages()
            ]
        ]);
    }



    // API endpoint untuk menyimpan universitas custom dari user
    public function storeCustom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'group' => 'nullable|in:PTN,PTS',
            'university_type' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'province' => 'nullable|string|max:100',
            'regency' => 'nullable|string|max:100',
        ]);

        // Cek apakah sudah ada dengan nama yang sama
        $existing = UniversitasCustomModel::where('name', $request->name)->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Data sudah ada',
                'data' => $existing,
            ]);
        }

        $custom = UniversitasCustomModel::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'group' => $request->group,
            'university_type' => $request->university_type,
            'address' => $request->address,
            'province' => $request->province,
            'regency' => $request->regency,
            'is_verified' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $custom,
        ]);
    }
}
