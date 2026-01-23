<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Kumulatif;
use App\Models\Sileg\Ruu;

class KumulatifController extends Controller
{
    public function index()
    {
        $kumulatifs = Kumulatif::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::kumulatif.index', compact('kumulatifs'));
    }

    public function create()
    {
        return view('sileg::kumulatif.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $kumulatif = Kumulatif::create($data);

        return redirect()->route('kumulatif.edit', ['id' => $kumulatif->id])
        ->with('success', 'Daftar Kumulatif berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kumulatif = Kumulatif::findOrFail($id);
        $ruus = Ruu::where('status', 1)
                ->where('id_kumulatif', $kumulatif->id)
                ->orderBy('id', 'desc')
                ->get();

        return view('sileg::kumulatif.edit', compact('kumulatif', 'ruus'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $kumulatif = Kumulatif::findOrFail($id);
        $kumulatif->update($data);

        return redirect()->route('kumulatif.index')
            ->with('success', 'Daftar Kumulatif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kumulatif = Kumulatif::findOrFail($id);
        $kumulatif->status = 9;
        $kumulatif->save();

        return redirect()->route('kumulatif.index')
            ->with('success', 'Kumulatif berhasil dihapus.');
    }
}
