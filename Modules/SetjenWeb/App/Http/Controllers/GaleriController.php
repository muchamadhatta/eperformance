<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\FotoAlbum;
use App\Models\Setjen\Foto;
use App\Models\Setjen\Video;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class GaleriController extends Controller
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
        $galeris = FotoAlbum::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('setjenweb::galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;


        if ($request->hasFile('thumbnail_name')) {
            $file = $request->file('thumbnail_name');
            $fileName = 'galeri' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/galeri";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail_name'] = "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }


        $galeri = FotoAlbum::create($data);
        return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri->id])
            ->with('success', 'Daftar Galeri berhasil ditambahkan.');


    }



    public function edit($id)
    {
        $galeri = FotoAlbum::findOrFail($id);
        $fotos = Foto::where('id_album', $id)->where('status', 1)->get();
        $videos = Video::where('id_album', $id)->where('status', 1)->get();
        $website = $galeri->website;

        return view('setjenweb::galeri.edit', compact('galeri', 'website', 'fotos', 'videos'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        if ($request->hasFile('thumbnail_name')) {
            $file = $request->file('thumbnail_name');
            $fileName = 'galeri' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/galeri";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail_name'] = "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }
        $galeri = FotoAlbum::findOrFail($id);
        $galeri->update($data);

        return redirect()->route('setjenweb.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $galeri = FotoAlbum::findOrFail($id);

        if ($jenis === 'img' && $galeri->thumbnail_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $galeri->thumbnail_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $galeri->update(['thumbnail_name' => null]);
            return redirect()->route('setjenweb.galeri.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->route('setjenweb.galeri.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }

    public function destroy($id)
    {
        $galeri = FotoAlbum::findOrFail($id);
        $galeri->status = 9;
        $galeri->save();

        return redirect()->route('setjenweb.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }


    // Galeri Foto
    public function store_galeri_foto(Request $request)
    {
        $data = $request->all();
        $id_galeri_foto = $data['id_album'];

        if ($request->hasFile('file_name')) {
            $files = $request->file('file_name');

            foreach ($files as $file) {

                $fileName = 'foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = "//172.16.30.157/www/eperformance/setjen/galeri";
                move_uploaded_file($file, $path . "/" . $fileName);

                $fotoData = [
                    'file_type' => $file->getClientMimeType(),
                    'file_name' => "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName,
                ];

                Foto::create(array_merge($data, $fotoData));
            }
        }

        return redirect()->route('setjenweb.galeri.edit', ['id' => $id_galeri_foto])
            ->with('success', 'Galeri Foto berhasil ditambah.');
    }

    public function update_galeri_foto(Request $request, $id)
    {
        $data = $request->all();


        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = 'foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/galeri";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['file_name'] = "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $galeri_foto = Foto::findOrFail($id);
        $galeri_foto->update($data);

        return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_foto->id_album])
            ->with('success', 'Galeri Foto berhasil diperbarui.');
    }

    public function deleteFoto($id, $jenis)
    {
        $galeri_foto = Foto::findOrFail($id);

        if ($jenis === 'img' && $galeri_foto->file_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $galeri_foto->file_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $galeri_foto->update(['file_name' => null]);
            return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_foto->id_album])
                ->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->route('setjenweb.galeri.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }

    public function destroy_galeri_foto($id)
    {
        $galeri_foto = Foto::findOrFail($id);
        $galeri_foto->status = 9;
        $galeri_foto->save();

        return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_foto->id_album])
            ->with('success', 'Galeri Foto berhasil dihapus.');
    }
    // Galeri Foto


    // Galeri Video
    public function store_galeri_video(Request $request)
    {
        $data = $request->all();
        $id_galeri_video = $data['id_album'];
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);

        if ($request->hasFile('thumbnail_name')) {
            $file = $request->file('thumbnail_name');
            $fileName = 'cover_video' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/galeri";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail_name'] = "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        Video::create($data);

        return redirect()->route('setjenweb.galeri.edit', ['id' => $id_galeri_video])
            ->with('success', 'Galeri Video berhasil ditambah.');
    }

    public function update_galeri_video(Request $request, $id)
    {
        $data = $request->all();
        $data['deskripsi'] = str_replace('<p>', '<p class="mb-3">', $data['deskripsi']);
        if ($request->hasFile('thumbnail_name')) {
            $file = $request->file('thumbnail_name');
            $fileName = 'cover_video' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/galeri";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail_name'] = "https://berkas.dpr.go.id/eperformance/setjen/galeri/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }
        $galeri_video = Video::findOrFail($id);
        $galeri_video->update($data);

        return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_video->id_album])
            ->with('success', 'Galeri Video berhasil diperbarui.');
    }

    public function deleteVideo($id, $jenis)
    {
        $galeri_video = Video::findOrFail($id);

        if ($jenis === 'img' && $galeri_video->thumbnail_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $galeri_video->thumbnail_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $galeri_video->update(['thumbnail_name' => null]);
            return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_video->id_album])
                ->with('success', 'Video berhasil dihapus.');
        }

        return redirect()->route('setjenweb.galeri.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }

    public function destroy_galeri_video($id)
    {
        $galeri_video = Video::findOrFail($id);
        $galeri_video->status = 9;
        $galeri_video->save();

        return redirect()->route('setjenweb.galeri.edit', ['id' => $galeri_video->id_album])
            ->with('success', 'Galeri Video berhasil dihapus.');
    }
    // Galeri Video

}
