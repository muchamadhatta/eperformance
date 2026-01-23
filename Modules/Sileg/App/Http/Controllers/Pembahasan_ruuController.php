<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Pembahasan_ruu;

class Pembahasan_ruuController extends Controller
{
    public function index()
    {
        $pembahasan_ruus = Pembahasan_ruu::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::pembahasan_ruu.index', compact('pembahasan_ruus'));
    }

    public function create()
    {
        return view('sileg::pembahasan_ruu.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $pembahasan_ruu = Pembahasan_ruu::create($data);

        return redirect()->route('pembahasan_ruu.edit', ['id' => $pembahasan_ruu->id])
        ->with('success', 'Daftar Pembahasan RUU berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembahasan_ruu = Pembahasan_ruu::findOrFail($id);
        return view('sileg::pembahasan_ruu.edit', compact('pembahasan_ruu'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $pembahasan_ruu = Pembahasan_ruu::findOrFail($id);
        $pembahasan_ruu->update($data);

        return redirect()->route('pembahasan_ruu.index')
            ->with('success', 'Daftar Pembahasan RUU berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembahasan_ruu = Pembahasan_ruu::findOrFail($id);
        $pembahasan_ruu->status = 9;
        $pembahasan_ruu->save();

        return redirect()->route('pembahasan_ruu.index')
            ->with('success', 'Pembahasan RUU berhasil dihapus.');
    }
}
