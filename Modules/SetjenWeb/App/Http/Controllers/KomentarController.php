<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Komentar;
use App\Models\Setjen\Berita;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;



class KomentarController extends Controller
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
        $komentars = Komentar::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::komentar.index', compact('komentars'));
    }

    public function create()
    {
        $newss = Berita::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::komentar.create', compact('newss'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'komentar' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/komentar";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/komentar/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $komentar = Komentar::create($data);
        return redirect()->route('setjenweb.komentar.edit', ['id' => $komentar->id])
            ->with('success', 'Daftar Komentar berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $komentar = Komentar::findOrFail($id);
        $newss = Berita::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::komentar.edit', compact('komentar', 'newss'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'komentar' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/komentar";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/komentar/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $komentar = Komentar::findOrFail($id);
        $komentar->update($data);

        return redirect()->route('setjenweb.komentar.index')
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $komentar = Komentar::findOrFail($id);

        if ($jenis === 'img' && $komentar->thumbnail) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $komentar->thumbnail);

            if (file_exists($path)) {
                unlink($path);
            }
            $komentar->update(['thumbnail' => null]);
            return redirect()->route('setjenweb.komentar.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->route('setjenweb.komentar.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->status = 9;
        $komentar->save();

        return redirect()->route('setjenweb.komentar.index')
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
