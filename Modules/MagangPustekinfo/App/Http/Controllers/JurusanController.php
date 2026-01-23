<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Models\JurusanModel;


class JurusanController extends Controller
{
    // Admin: List all jurusan
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $query = JurusanModel::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('faculty', 'like', '%' . $search . '%');
            });
        }
        
        $jurusan = $query->orderBy('name', 'asc')->paginate($perPage);
        $totalCount = JurusanModel::count();
        
        return view('magangpustekinfo::admin.jurusan.index', [
            'jurusan' => $jurusan,
            'search' => $search,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
        ]);
    }

    // Admin: Create form
    public function create()
    {
        return view('magangpustekinfo::admin.jurusan.create');
    }

    // Admin: Store new jurusan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:20',
            'faculty' => 'nullable|string|max:255',
        ]);

        // Cek duplikat
        $existing = JurusanModel::where('name', $request->name)->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        JurusanModel::create([
            'name' => \Illuminate\Support\Str::title($request->name),
            'level' => $request->level,
            'faculty' => $request->faculty,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('magangpustekinfo.admin.jurusan.index');
    }

    // Admin: Edit form
    public function edit($id)
    {
        $jurusan = JurusanModel::findOrFail($id);
        return view('magangpustekinfo::admin.jurusan.edit', compact('jurusan'));
    }

    // Admin: Update jurusan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:20',
            'faculty' => 'nullable|string|max:255',
        ]);

        $jurusan = JurusanModel::findOrFail($id);
        
        // Cek duplikat (kecuali diri sendiri)
        $existing = JurusanModel::where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        $jurusan->update([
            'name' => \Illuminate\Support\Str::title($request->name),
            'level' => $request->level,
            'faculty' => $request->faculty,
        ]);

        Alert::success('Berhasil', 'Data berhasil diupdate!');
        return redirect()->route('magangpustekinfo.admin.jurusan.index');
    }

    // Admin: Delete jurusan
    public function destroy($id)
    {
        $jurusan = JurusanModel::findOrFail($id);
        $jurusan->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('magangpustekinfo.admin.jurusan.index');
    }

    // API: Search jurusan for autocomplete
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $type = $request->get('type', ''); // 'Magang' or 'PKL'
        
        $dbQuery = JurusanModel::where('name', 'like', '%' . $query . '%');

        if ($type === 'Magang') {
            // Filter hanya level kuliah atau NULL
            $dbQuery->where(function($q) {
                $q->whereIn('level', ['D3', 'D4', 'S1', 'S2', 'S3'])
                  ->orWhereNull('level');
            });
        } elseif ($type === 'PKL') {
            // Filter hanya level sekolah atau NULL
            $dbQuery->where(function($q) {
                $q->whereIn('level', ['SMK', 'SMA'])
                  ->orWhereNull('level');
            });
        }

        $jurusan = $dbQuery->orderBy('name', 'asc')
            ->limit(20)
            ->get();
        
        $data = [];
        foreach ($jurusan as $item) {
            $data[] = [
                'id' => $item->name,
                'text' => $item->name . ($item->level ? " ({$item->level})" : ''),
            ];
        }
        
        return response()->json([
            'results' => $data,
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    // API: Store new jurusan from frontend
    public function storeCustom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:20',
            'faculty' => 'nullable|string|max:255',
        ]);

        // Cek apakah sudah ada dengan nama yang sama
        $existing = JurusanModel::where('name', $request->name)->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Data sudah ada',
                'data' => $existing,
            ]);
        }

        $jurusan = JurusanModel::create([
            'name' => \Illuminate\Support\Str::title($request->name),
            'level' => $request->level,
            'faculty' => $request->faculty,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $jurusan,
        ]);
    }
}
