<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Models\SekolahCustomModel;

class SekolahCustomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $query = SekolahCustomModel::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('npsn', 'like', '%' . $search . '%')
                  ->orWhere('province_name', 'like', '%' . $search . '%');
            });
        }
        
        $sekolahCustom = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $totalCount = SekolahCustomModel::count();
        
        return view('magangpustekinfo::admin.sekolah_custom.index', [
            'sekolahCustom' => $sekolahCustom,
            'search' => $search,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
        ]);
    }

    public function create()
    {
        return view('magangpustekinfo::admin.sekolah_custom.create');
    }

    public function store(Request $request)
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

        // Cek duplikat
        $existing = SekolahCustomModel::where('name', $request->name)->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        SekolahCustomModel::create([
            'name' => $request->name,
            'npsn' => $request->npsn,
            'grade' => $request->grade,
            'status' => $request->status,
            'address' => $request->address,
            'province_name' => $request->province_name,
            'regency_name' => $request->regency_name,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('magangpustekinfo.admin.sekolah_custom.index');
    }

    public function edit($id)
    {
        $sekolahCustom = SekolahCustomModel::findOrFail($id);
        return view('magangpustekinfo::admin.sekolah_custom.edit', compact('sekolahCustom'));
    }

    public function update(Request $request, $id)
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

        $sekolahCustom = SekolahCustomModel::findOrFail($id);
        
        // Cek duplikat (kecuali diri sendiri)
        $existing = SekolahCustomModel::where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        $sekolahCustom->update([
            'name' => $request->name,
            'npsn' => $request->npsn,
            'grade' => $request->grade,
            'status' => $request->status,
            'address' => $request->address,
            'province_name' => $request->province_name,
            'regency_name' => $request->regency_name,
        ]);

        Alert::success('Berhasil', 'Data berhasil diupdate!');
        return redirect()->route('magangpustekinfo.admin.sekolah_custom.index');
    }

    public function destroy($id)
    {
        $sekolahCustom = SekolahCustomModel::findOrFail($id);
        $sekolahCustom->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('magangpustekinfo.admin.sekolah_custom.index');
    }
}
