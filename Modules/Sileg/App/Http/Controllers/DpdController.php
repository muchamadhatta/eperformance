<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Dpd;

class DpdController extends Controller
{
    public function index()
    {
        $dpds = Dpd::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::dpd.index', compact('dpds'));
    }

    public function create()
    {
        return view('sileg::dpd.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $dpd = Dpd::create($data);
        return redirect()->route('dpd.edit', ['id' => $dpd->id])
        ->with('success', 'Daftar DPD berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $dpd = Dpd::findOrFail($id);
        return view('sileg::dpd.edit', compact('dpd'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $dpd = Dpd::findOrFail($id);
        $dpd->update($data);

        return redirect()->route('dpd.index')
            ->with('success', 'Daftar DPD berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dpd = Dpd::findOrFail($id);
        $dpd->status = 9;
        $dpd->save();

        return redirect()->route('dpd.index')
            ->with('success', 'DPD berhasil dihapus.');
    }
}
