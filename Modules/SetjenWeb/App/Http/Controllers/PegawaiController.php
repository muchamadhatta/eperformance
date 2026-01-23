<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\User;
use Illuminate\Support\Facades\File;


class PegawaiController extends Controller
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
        $pegawais = User::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('setjenweb::pegawai.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = 'foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pegawai";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['foto'] = "https://berkas.dpr.go.id/eperformance/setjen/pegawai/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName = 'cv' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pegawai";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['cv'] = "https://berkas.dpr.go.id/eperformance/setjen/pegawai/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }
        $pegawai = User::create($data);
        return redirect()->route('setjenweb.pegawai.edit', ['id' => $pegawai->id])
        ->with('success', 'Daftar Pegawai berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $pegawai = User::findOrFail($id);
        return view('setjenweb::pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = 'foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pegawai";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['foto'] = "https://berkas.dpr.go.id/eperformance/setjen/pegawai/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName = 'cv' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pegawai";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['cv'] = "https://berkas.dpr.go.id/eperformance/setjen/pegawai/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $pegawai = User::findOrFail($id);
        $pegawai->update($data);

        return redirect()->route('setjenweb.pegawai.index')
            ->with('success', 'Daftar Pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->delete();


        return redirect()->route('setjenweb.pegawai.index')
            ->with('success', 'Pegawai berhasil dihapus.');
    }


    public function deleteFile($id, $jenis)
    {
        $pegawai = User::findOrFail($id);

        if ($jenis === 'img' && $pegawai->foto) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $pegawai->foto);

            if (file_exists($path)) {
                unlink($path);
            }
            $pegawai->update(['foto' => null]);
            return redirect()->route('setjenweb.pegawai.edit', $id)->with('success', 'Foto berhasil dihapus.');
        }
        if ($jenis === 'pdf' && $pegawai->cv) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $pegawai->cv);

            if (file_exists($path)) {
                unlink($path);
            }
            $pegawai->update(['cv' => null]);
            return redirect()->route('setjenweb.pegawai.edit', $id)->with('success', 'CV berhasil dihapus.');
        }

        return redirect()->route('setjenweb.pegawai.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }
}
