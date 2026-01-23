<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Akd;

class KomisiController extends Controller
{
    public function index()
    {
        // $komisis = Akd::where('status', 1)->orderBy('id', 'desc')->get();

        $komisis = Akd::where('status', 1)
            ->where('akd', 'like', '%Komisi%')
            ->orderBy('id', 'asc')
            ->get();

        return view('sileg::komisi.index', compact('komisis'));
    }

    public function create()
    {
        return view('sileg::komisi.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $komisi = Akd::create($data);
        return redirect()->route('komisi.edit', ['id' => $komisi->id])
            ->with('success', 'Daftar Komisi berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $komisi = Akd::findOrFail($id);
        return view('sileg::komisi.edit', compact('komisi'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $komisi = Akd::findOrFail($id);
        $komisi->update($data);

        return redirect()->route('komisi.index')
            ->with('success', 'Daftar Komisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $komisi = Akd::findOrFail($id);
        $komisi->status = 9;
        $komisi->save();

        return redirect()->route('komisi.index')
            ->with('success', 'Komisi berhasil dihapus.');
    }
}
