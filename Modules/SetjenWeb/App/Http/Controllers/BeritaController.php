<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Berita;
use App\Models\Setjen\WebsiteMenu;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BeritaController extends Controller
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
        $beritas = Berita::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::berita.index', compact('beritas'));
    }

    public function create()
    {
        $website_menu = WebsiteMenu::where('id_website', $this->id_website)
            ->where('type', 'kegiatan')
            ->where('param', 'berita')
            ->firstOrFail();
        return view('setjenweb::berita.create', compact('website_menu'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'news' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/berita";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/berita/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $berita = Berita::create($data);
        return redirect()->route('setjenweb.berita.edit', ['id' => $berita->id])
            ->with('success', 'Daftar Berita berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('setjenweb::berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'news' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/berita";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/berita/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $berita = Berita::findOrFail($id);
        $berita->update($data);

        return redirect()->route('setjenweb.berita.index')
            ->with('success', 'Daftar Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = 9;
        $berita->save();

        return redirect()->route('setjenweb.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function deleteThumbnail($id, $jenis)
    {
        $berita = Berita::findOrFail($id);

        if ($jenis === 'img' && $berita->thumbnail) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $berita->thumbnail);

            if (file_exists($path)) {
                unlink($path);
            }

            $berita->update(['thumbnail' => null]);

            return redirect()->route('setjenweb.berita.edit', ['id' => $berita->id])
                ->with('success', 'Thumbnail berhasil dihapus.');
        }

        return redirect()->route('setjenweb.berita.edit', ['id' => $berita->id])
            ->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');
    }

}
