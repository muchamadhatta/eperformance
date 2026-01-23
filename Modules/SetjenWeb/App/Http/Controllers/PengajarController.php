<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Pengajar;
use Illuminate\Support\Facades\File;


class PengajarController extends Controller
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
        $pengajars = Pengajar::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::pengajar.index', compact('pengajars'));
    }

    public function create()
    {
        return view('setjenweb::pengajar.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            $fileName = 'pas_foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pengajar";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['pas_foto'] = "https://berkas.dpr.go.id/eperformance/setjen/pengajar/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $pengajar = Pengajar::create($data);
        return redirect()->route('setjenweb.pengajar.edit', ['id' => $pengajar->id])
        ->with('success', 'Daftar Pengajar berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        return view('setjenweb::pengajar.edit', compact('pengajar'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            $fileName = 'pas_foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/pengajar";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['pas_foto'] = "https://berkas.dpr.go.id/eperformance/setjen/pengajar/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $pengajar = Pengajar::findOrFail($id);
        $pengajar->update($data);

        return redirect()->route('setjenweb.pengajar.index')
            ->with('success', 'Daftar Pengajar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $pengajar->status = 9;
        $pengajar->save();

        return redirect()->route('setjenweb.pengajar.index')
            ->with('success', 'Pengajar berhasil dihapus.');
    }


    public function deleteFile($id, $jenis)
    {
        $pengajar = Pengajar::findOrFail($id);

        if ($jenis === 'img' && $pengajar->pas_foto) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $pengajar->pas_foto);

            if (file_exists($path)) {
                unlink($path);
            }
            $pengajar->update(['pas_foto' => null]);
            return redirect()->route('setjenweb.pengajar.edit', $id)->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->route('setjenweb.pengajar.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }
}
