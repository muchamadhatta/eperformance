<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Fraksi;

class FraksiController extends Controller
{
    public function index()
    {
        $fraksis = Fraksi::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::fraksi.index', compact('fraksis'));
    }

    public function create()
    {
        return view('sileg::fraksi.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $fraksi = Fraksi::create($data);
        return redirect()->route('fraksi.edit', ['id' => $fraksi->id])
        ->with('success', 'Daftar Fraksi berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $fraksi = Fraksi::findOrFail($id);
        return view('sileg::fraksi.edit', compact('fraksi'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $fraksi = Fraksi::findOrFail($id);
        $fraksi->update($data);

        return redirect()->route('fraksi.index')
            ->with('success', 'Daftar Fraksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fraksi = Fraksi::findOrFail($id);
        $fraksi->status = 9;
        $fraksi->save();

        return redirect()->route('fraksi.index')
            ->with('success', 'Fraksi berhasil dihapus.');
    }
}
