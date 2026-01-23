<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Mou;
use App\Models\Setjen\Provinsi;
use App\Models\Setjen\Dokumen;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class MouController extends Controller
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
        $mous = Mou::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::mou.index', compact('mous'));
    }

    public function create()
    {
        $provinsis = Provinsi::where('id_website', $this->id_website)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        $dokumens = Dokumen::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::mou.create', compact('provinsis', 'dokumens'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'mou' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/mou";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['logo'] = "https://berkas.dpr.go.id/eperformance/setjen/mou/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        if ($request->hasFile('materi')) {
            $file = $request->file('materi');
            $fileName = 'mou' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/mou";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['materi'] = "https://berkas.dpr.go.id/eperformance/setjen/mou/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $mou = Mou::create($data);
        return redirect()->route('setjenweb.mou.edit', ['id' => $mou->id])
            ->with('success', 'Daftar Mou berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $mou = Mou::findOrFail($id);
        $provinsis = Provinsi::where('id_website', $this->id_website)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        $dokumens = Dokumen::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::mou.edit', compact('mou', 'provinsis', 'dokumens'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'mou' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/mou";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['logo'] = "https://berkas.dpr.go.id/eperformance/setjen/mou/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        if ($request->hasFile('materi')) {
            $file = $request->file('materi');
            $fileName = 'mou' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/mou";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['materi'] = "https://berkas.dpr.go.id/eperformance/setjen/mou/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $mou = Mou::findOrFail($id);
        $mou->update($data);

        return redirect()->route('setjenweb.mou.index')
            ->with('success', 'Mou berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $mou = Mou::findOrFail($id);

        if ($jenis === 'img' && $mou->logo) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $mou->logo);

            if (file_exists($path)) {
                unlink($path);
            }
            $mou->update(['logo' => null]);
            return redirect()->route('setjenweb.mou.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        if ($jenis === 'pdf' && $mou->materi) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $mou->materi);

            if (file_exists($path)) {
                unlink($path);
            }
            $mou->update(['materi' => null]);
            return redirect()->route('setjenweb.mou.edit', $id)->with('success', 'File berhasil dihapus.');
        }

        return redirect()->route('setjenweb.mou.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $mou = Mou::findOrFail($id);
        $mou->delete();

        return redirect()->route('setjenweb.mou.index')
            ->with('success', 'Mou berhasil dihapus.');
    }
}
