<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\KategoriProjectService;
use Modules\MagangPustekinfo\App\Models\KategoriProjectModel;

class KategoriProjectController extends Controller
{
    protected $kategoriProjectService;

    public function __construct(KategoriProjectService $kategoriProjectService)
    {
        $this->kategoriProjectService = $kategoriProjectService;
    }

    // Admin: List all kategori project
    public function index(Request $request)
    {
        $kategori = $this->kategoriProjectService->getAllActiveKategoriProject($request);
        
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        $totalCount = KategoriProjectModel::count();
        $activeCount = KategoriProjectModel::active()->count();
        
        return view('magangpustekinfo::admin.kategori_project.index', [
            'kategori' => $kategori,
            'search' => $search,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
        ]);
    }

    // Admin: Create form
    public function create()
    {
        return view('magangpustekinfo::admin.kategori_project.create');
    }

    // Admin: Store new kategori
    public function store(Request $request)
    {
        try {
            $validatedData = $this->kategoriProjectService->validateKategoriProjectData($request);

            // Cek duplikat
            if ($this->kategoriProjectService->checkDuplicate($request->name)) {
                Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
                return redirect()->back()->withInput();
            }

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $request->icon ?? 'ri-folder-line',
                'is_active' => $request->has('is_active'),
                'sort_order' => $request->sort_order ?? 0,
            ];

            $this->kategoriProjectService->createKategoriProject($data);

            Alert::success('Berhasil', 'Data berhasil ditambahkan!');
            return redirect()->route('magangpustekinfo.admin.kategori_project.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Admin: Edit form
    public function edit($id)
    {
        try {
            $kategori = $this->kategoriProjectService->getKategoriProjectById($id);
            return view('magangpustekinfo::admin.kategori_project.edit', compact('kategori'));
        } catch (\Exception $e) {
            return redirect()->route('magangpustekinfo.admin.kategori_project.index')
                ->with('error', 'Data tidak ditemukan.');
        }
    }

    // Admin: Update kategori
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->kategoriProjectService->validateKategoriProjectData($request, $id);

            // Cek duplikat
            if ($this->kategoriProjectService->checkDuplicate($request->name, $id)) {
                Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
                return redirect()->back()->withInput();
            }

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $request->icon ?? 'ri-folder-line',
                'is_active' => $request->has('is_active'),
                'sort_order' => $request->sort_order,
            ];

            $this->kategoriProjectService->updateKategoriProject($id, $data);

            Alert::success('Berhasil', 'Data berhasil diupdate!');
            return redirect()->route('magangpustekinfo.admin.kategori_project.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Admin: Delete kategori
    public function destroy($id)
    {
        try {
            $this->kategoriProjectService->deleteKategoriProject($id);
            Alert::success('Berhasil', 'Data berhasil dihapus!');
            return redirect()->route('magangpustekinfo.admin.kategori_project.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
            return redirect()->route('magangpustekinfo.admin.kategori_project.index');
        }
    }

    // Toggle status aktif
    public function toggleStatus($id)
    {
        try {
            $kategori = $this->kategoriProjectService->toggleStatus($id);
            $status = $kategori->is_active ? 'diaktifkan' : 'dinonaktifkan';
            Alert::success('Berhasil', "Kategori berhasil {$status}!");
            return redirect()->route('magangpustekinfo.admin.kategori_project.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan.');
            return redirect()->back();
        }
    }
}
