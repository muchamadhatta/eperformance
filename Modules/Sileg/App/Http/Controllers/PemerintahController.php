<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Pemerintah;

class PemerintahController extends Controller
{
    public function index()
    {
        $pemerintahs = Pemerintah::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::pemerintah.index', compact('pemerintahs'));
    }

    public function create()
    {
        return view('sileg::pemerintah.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $pemerintah = Pemerintah::create($data);

        return redirect()->route('pemerintah.edit', ['id' => $pemerintah->id])
        ->with('success', 'Daftar Pemerintah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemerintah = Pemerintah::findOrFail($id);
        return view('sileg::pemerintah.edit', compact('pemerintah'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $pemerintah = Pemerintah::findOrFail($id);
        $pemerintah->update($data);

        return redirect()->route('pemerintah.index')
            ->with('success', 'Daftar Pemerintah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemerintah = Pemerintah::findOrFail($id);
        $pemerintah->status = 9;
        $pemerintah->save();

        return redirect()->route('pemerintah.index')
            ->with('success', 'Pemerintah berhasil dihapus.');
    }
}
