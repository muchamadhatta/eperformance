<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setjen\JenisDokumen;
use Illuminate\Http\Request;
use App\Models\Setjen\Dokumen;
use App\Models\Setjen\WebsiteMenu;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class PublikasiController extends Controller
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
        $publikasis = Dokumen::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::publikasi.index', compact('publikasis'));
    }

    public function create()
    {
        $website_menus = WebsiteMenu::where('id_website', $this->id_website)->where('type', 'publikasi')->orderBy('id', 'asc')->get();
        $jenis_dokumens = JenisDokumen::orderBy('id', 'asc')->get();
        return view('setjenweb::publikasi.create', compact('website_menus', 'jenis_dokumens'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('cover_file_name')) {
            $file = $request->file('cover_file_name');
            $fileName = 'publikasi' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/publikasi";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['cover_file_name'] = "https://berkas.dpr.go.id/eperformance/setjen/publikasi/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
        }

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = 'publikasi' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/publikasi";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['file_name'] = "https://berkas.dpr.go.id/eperformance/setjen/publikasi/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $publikasi = Dokumen::create($data);
        return redirect()->route('setjenweb.publikasi.edit', ['id' => $publikasi->id])
            ->with('success', 'Daftar Publikasi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $publikasi = Dokumen::findOrFail($id);
        $website_menus = WebsiteMenu::where('id_website', $this->id_website)->where('type', 'publikasi')->orderBy('id', 'asc')->get();
        $jenis_dokumens = JenisDokumen::orderBy('id', 'asc')->get();
        return view('setjenweb::publikasi.edit', compact('publikasi', 'website_menus', 'jenis_dokumens'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        if ($request->hasFile('cover_file_name')) {
            $file = $request->file('cover_file_name');
            $fileName = 'publikasi' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/publikasi";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['cover_file_name'] = "https://berkas.dpr.go.id/eperformance/setjen/publikasi/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
        }

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = 'publikasi' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/publikasi";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['file_name'] = "https://berkas.dpr.go.id/eperformance/setjen/publikasi/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $publikasi = Dokumen::findOrFail($id);
        $publikasi->update($data);

        return redirect()->route('setjenweb.publikasi.index')
            ->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $publikasi = Dokumen::findOrFail($id);

        if ($jenis === 'img' && $publikasi->cover_file_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $publikasi->cover_file_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $publikasi->update(['cover_file_name' => null]);
            return redirect()->route('setjenweb.publikasi.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        if ($jenis === 'pdf' && $publikasi->file_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $publikasi->file_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $publikasi->update(['file_name' => null]);
            return redirect()->route('setjenweb.publikasi.edit', $id)->with('success', 'File berhasil dihapus.');
        }

        return redirect()->route('setjenweb.publikasi.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $publikasi = Dokumen::findOrFail($id);
        $publikasi->delete();

        return redirect()->route('setjenweb.publikasi.index')
            ->with('success', 'Publikasi berhasil dihapus.');
    }
}
