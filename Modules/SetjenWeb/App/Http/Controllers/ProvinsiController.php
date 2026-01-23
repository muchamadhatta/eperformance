<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Provinsi;
use Illuminate\Support\Facades\File;


class ProvinsiController extends Controller
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
        $provinsis = Provinsi::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::provinsi.index', compact('provinsis'));
    }

    public function create()
    {
        return view('setjenweb::provinsi.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        $provinsi = Provinsi::create($data);
        return redirect()->route('setjenweb.provinsi.edit', ['id' => $provinsi->id])
            ->with('success', 'Daftar Provinsi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('setjenweb::provinsi.edit', compact('provinsi'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update($data);

        return redirect()->route('setjenweb.provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->route('setjenweb.provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus.');
    }

}


