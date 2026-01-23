<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setjen\StrukturOrganisasiUser;
use Illuminate\Http\Request;
use App\Models\Setjen\StrukturOrganisasi;
use App\Models\Setjen\User;


class OrganisasiController extends Controller
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
        $organisasis = StrukturOrganisasi::where('status', 1)->where('id_website', $this->id_website)->where('parent', null)->orderBy('id', 'asc')->get();

        $organisasi_users = StrukturOrganisasiUser::get();


        return view('setjenweb::organisasi.index', compact('organisasis', 'organisasi_users'));
    }

    public function create()
    {
        return view('setjenweb::organisasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        $organisasi = StrukturOrganisasi::create($data);
        return redirect()->route('setjenweb.organisasi.edit', ['id' => $organisasi->id])
            ->with('success', 'Daftar Organisasi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $organisasi = StrukturOrganisasi::findOrFail($id);
        $datas = StrukturOrganisasi::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();

        $id_user = $organisasi->strukturOrganisasiUser()->value('id_user');
        $users = User::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();

        return view('setjenweb::organisasi.edit', compact('organisasi', 'datas', 'id_user', 'users'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $organisasi = StrukturOrganisasi::findOrFail($id);
        $organisasi->update($data);

        // Menemukan atau membuat entri StrukturOrganisasiUser
        $id_user = $data['id_user']; // Pastikan Anda memperoleh id_user dari input
        $organisasi_user = StrukturOrganisasiUser::where('id_struktur_organisasi', $organisasi->id)->first();

        if (!$organisasi_user) {
            // Jika entri StrukturOrganisasiUser tidak ditemukan, buat baru
            $organisasi_user = new StrukturOrganisasiUser();
            $organisasi_user->id_struktur_organisasi = $organisasi->id;
        }

        // Set nilai id_user yang baru atau yang telah diubah
        $organisasi_user->id_user = $id_user;
        $organisasi_user->save();

        return redirect()->route('setjenweb.organisasi.index')
            ->with('success', 'Organisasi berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $organisasi = StrukturOrganisasi::findOrFail($id);
        $organisasi->status = 9;
        $organisasi->save();

        return redirect()->route('setjenweb.organisasi.index')
            ->with('success', 'Organisasi berhasil dihapus.');
    }

    public function store_organisasi_data(Request $request)
    {
        $data = $request->all();

        $organisasi = StrukturOrganisasi::create($data);
        return redirect()->route('setjenweb.organisasi.edit', ['id' => $organisasi->parent])
            ->with('success', 'Data berhasil ditambahkan.');
    }


    // public function update_organisasi_data(Request $request, $id)
    // {
    //     $data = $request->all();

    //     $organisasi = Organisasi::findOrFail($id);
    //     $organisasi->update($data);

    //     return redirect()->route('setjenweb.organisasi.edit', ['id' => $organisasi->parent])
    //         ->with('success', 'Data berhasil diperbaharui.');
    // }


    public function destroy_organisasi_data($id)
    {
        $organisasi = StrukturOrganisasi::findOrFail($id);
        $organisasi->status = 9;
        $organisasi->save();

        return redirect()->route('setjenweb.organisasi.edit', ['id' => $organisasi->parent])
            ->with('success', 'Data berhasil dihapus.');
    }

}


