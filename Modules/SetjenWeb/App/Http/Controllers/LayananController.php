<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Layanan;
use App\Models\Setjen\Menu;
use Illuminate\Support\Facades\File;


class LayananController extends Controller
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
        $layanans = Layanan::where('id_website', $this->id_website)->where('parent', null)->orderBy('id', 'asc')->get();
        return view('setjenweb::layanan.index', compact('layanans'));
    }

    public function create()
    {
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::layanan.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        $layanan = Layanan::create($data);
        return redirect()->route('setjenweb.layanan.edit', ['id' => $layanan->id])
            ->with('success', 'Daftar Layanan berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $datas = Layanan::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::layanan.edit', compact('layanan', 'datas', 'menus'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $layanan = Layanan::findOrFail($id);
        $layanan->update($data);

        return redirect()->route('setjenweb.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('setjenweb.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    public function store_layanan_data(Request $request)
    {
        $data = $request->all();

        $layanan = Layanan::create($data);
        return redirect()->route('setjenweb.layanan.edit', ['id' => $layanan->parent])
            ->with('success', 'Data berhasil ditambahkan.');
    }


    public function update_layanan_data(Request $request, $id)
    {
        $data = $request->all();

        $layanan = Layanan::findOrFail($id);
        $layanan->update($data);

        return redirect()->route('setjenweb.layanan.edit', ['id' => $layanan->parent])
            ->with('success', 'Data berhasil diperbaharui.');
    }


    public function destroy_layanan_data($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->status = 9;
        $layanan->save();

        return redirect()->route('setjenweb.layanan.edit', ['id' => $layanan->parent])
            ->with('success', 'Data berhasil dihapus.');
    }

}


