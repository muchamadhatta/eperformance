<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Models\UniversitasCustomModel;

class UniversitasCustomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $query = UniversitasCustomModel::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('short_name', 'like', '%' . $search . '%')
                  ->orWhere('province', 'like', '%' . $search . '%');
            });
        }
        
        $universitasCustom = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $totalCount = UniversitasCustomModel::count();
        $verifiedCount = UniversitasCustomModel::where('is_verified', true)->count();
        $pendingCount = UniversitasCustomModel::where('is_verified', false)->count();
        
        return view('magangpustekinfo::admin.universitas_custom.index', [
            'universitasCustom' => $universitasCustom,
            'search' => $search,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
            'verifiedCount' => $verifiedCount,
            'pendingCount' => $pendingCount,
        ]);
    }

    public function create()
    {
        return view('magangpustekinfo::admin.universitas_custom.create');
    }

    public function store(Request $request)
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

        // Cek duplikat
        $existing = UniversitasCustomModel::where('name', $request->name)->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        UniversitasCustomModel::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'group' => $request->group,
            'university_type' => $request->university_type,
            'address' => $request->address,
            'province' => $request->province,
            'regency' => $request->regency,
            'is_verified' => true, // Admin input langsung verified
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');
        return redirect()->route('magangpustekinfo.admin.universitas_custom.index');
    }

    public function edit($id)
    {
        $universitasCustom = UniversitasCustomModel::findOrFail($id);
        return view('magangpustekinfo::admin.universitas_custom.edit', compact('universitasCustom'));
    }

    public function update(Request $request, $id)
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

        $universitasCustom = UniversitasCustomModel::findOrFail($id);
        
        // Cek duplikat (kecuali diri sendiri)
        $existing = UniversitasCustomModel::where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            Alert::error('Gagal', 'Data dengan nama yang sama sudah ada!');
            return redirect()->back()->withInput();
        }

        $universitasCustom->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'group' => $request->group,
            'university_type' => $request->university_type,
            'address' => $request->address,
            'province' => $request->province,
            'regency' => $request->regency,
        ]);

        Alert::success('Berhasil', 'Data berhasil diupdate!');
        return redirect()->route('magangpustekinfo.admin.universitas_custom.index');
    }

    public function destroy($id)
    {
        $universitasCustom = UniversitasCustomModel::findOrFail($id);
        $universitasCustom->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus!');
        return redirect()->route('magangpustekinfo.admin.universitas_custom.index');
    }

    public function verify($id)
    {
        $universitasCustom = UniversitasCustomModel::findOrFail($id);
        $universitasCustom->update(['is_verified' => true]);

        Alert::success('Berhasil', 'Data berhasil diverifikasi!');
        return redirect()->route('magangpustekinfo.admin.universitas_custom.index');
    }
}
