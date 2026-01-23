<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Billboard;
use Illuminate\Support\Facades\File;


class BillboardController extends Controller
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
        $billboards = Billboard::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::billboard.index', compact('billboards'));
    }

    public function create()
    {

        return view('setjenweb::billboard.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;

        if ($request->hasFile('image_name')) {
            $file = $request->file('image_name');
            $fileName = 'billboard' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/billboard";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['image_name'] = "https://berkas.dpr.go.id/eperformance/setjen/billboard/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $billboard = Billboard::create($data);
        return redirect()->route('setjenweb.billboard.edit', ['id' => $billboard->id])
            ->with('success', 'Daftar Billboard berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $billboard = Billboard::findOrFail($id);
        return view('setjenweb::billboard.edit', compact('billboard'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('image_name')) {
            $file = $request->file('image_name');
            $fileName = 'billboard' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/billboard";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['image_name'] = "https://berkas.dpr.go.id/eperformance/setjen/billboard/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $billboard = Billboard::findOrFail($id);
        $billboard->update($data);

        return redirect()->route('setjenweb.billboard.index')
            ->with('success', 'Billboard berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $billboard = Billboard::findOrFail($id);

        if ($jenis === 'img' && $billboard->image_name) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $billboard->image_name);

            if (file_exists($path)) {
                unlink($path);
            }
            $billboard->update(['image_name' => null]);
            return redirect()->route('setjenweb.billboard.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->route('setjenweb.billboard.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $billboard = Billboard::findOrFail($id);
        $billboard->status = 9;
        $billboard->save();

        return redirect()->route('setjenweb.billboard.index')
            ->with('success', 'Billboard berhasil dihapus.');
    }
}
