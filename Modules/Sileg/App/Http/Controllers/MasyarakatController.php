<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Masyarakat;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakats = Masyarakat::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::masyarakat.index', compact('masyarakats'));
    }

    public function create()
    {
        return view('sileg::masyarakat.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $masyarakat = Masyarakat::create($data);

        return redirect()->route('masyarakat.edit', ['id' => $masyarakat->id])
        ->with('success', 'Daftar Masyarakat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('sileg::masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->update($data);

        return redirect()->route('masyarakat.index')
            ->with('success', 'Daftar Masyarakat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->status = 9;
        $masyarakat->save();

        return redirect()->route('masyarakat.index')
            ->with('success', 'Masyarakat berhasil dihapus.');
    }
}
