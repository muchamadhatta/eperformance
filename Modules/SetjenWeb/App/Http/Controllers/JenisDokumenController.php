<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\JenisDokumen;

class JenisDokumenController extends Controller
{
    protected $id_website;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_website = $request->session()->get('id_website');
            return $next($request);
        });
    }
    public function index()
    {
        $jenis_dokumens = JenisDokumen::orderBy('id', 'asc')->get();
        return view('setjenweb::jenis_dokumen.index', compact('jenis_dokumens'));
    }

    public function create()
    {
        return view('setjenweb::jenis_dokumen.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $jenis_dokumen = JenisDokumen::create($data);
        return redirect()->route('setjenweb.jenis_dokumen.edit', ['id' => $jenis_dokumen->id])
        ->with('success', 'Daftar Jenis Dokumen berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $jenis_dokumen = JenisDokumen::findOrFail($id);
        return view('setjenweb::jenis_dokumen.edit', compact('jenis_dokumen'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $jenis_dokumen = JenisDokumen::findOrFail($id);
        $jenis_dokumen->update($data);

        return redirect()->route('setjenweb.jenis_dokumen.index')
            ->with('success', 'Daftar Jenis Dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis_dokumen = JenisDokumen::findOrFail($id);
        $jenis_dokumen->delete();

        return redirect()->route('setjenweb.jenis_dokumen.index')
            ->with('success', 'Jenis Dokumen berhasil dihapus.');
    }
}
