<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Statik;
use App\Models\Setjen\Menu;
use Illuminate\Support\Facades\File;


class StatikController extends Controller
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
        $statiks = Statik::where('status', 1)->where('id_website', $this->id_website)->where('parent', null)->orderBy('id', 'asc')->get();
        return view('setjenweb::statik.index', compact('statiks'));
    }

    public function create()
    {
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::statik.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'statik' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/statik";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/statik/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $statik = Statik::create($data);
        return redirect()->route('setjenweb.statik.edit', ['id' => $statik->id])
            ->with('success', 'Daftar Statik berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $statik = Statik::findOrFail($id);
        $datas = Statik::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        $menus = Menu::where('status', 1)->orderBy('id', 'asc')->get();
        return view('setjenweb::statik.edit', compact('statik', 'datas', 'menus'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'statik' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/statik";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/statik/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $statik = Statik::findOrFail($id);
        $statik->update($data);

        return redirect()->route('setjenweb.statik.index')
            ->with('success', 'Statik berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $statik = Statik::findOrFail($id);

        if ($jenis === 'img' && $statik->thumbnail) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $statik->thumbnail);

            if (file_exists($path)) {
                unlink($path);
            }
            $statik->update(['thumbnail' => null]);
            return redirect()->route('setjenweb.statik.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->route('setjenweb.statik.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $statik = Statik::findOrFail($id);
        $statik->status = 9;
        $statik->save();

        return redirect()->route('setjenweb.statik.index')
            ->with('success', 'Statik berhasil dihapus.');
    }

    public function store_statik_data(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'statik' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/statik";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/statik/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }
        $statik = Statik::create($data);
        return redirect()->route('setjenweb.statik.edit', ['id' => $statik->parent])
            ->with('success', 'Data berhasil ditambahkan.');
    }


    public function update_statik_data(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = 'statik' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/statik";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['thumbnail'] = "https://berkas.dpr.go.id/eperformance/setjen/statik/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }
        $statik = Statik::findOrFail($id);
        $statik->update($data);

        return redirect()->route('setjenweb.statik.edit', ['id' => $statik->parent])
            ->with('success', 'Data berhasil diperbaharui.');
    }


    public function destroy_statik_data($id)
    {
        $statik = Statik::findOrFail($id);
        $statik->delete();

        return redirect()->route('setjenweb.statik.edit', ['id' => $statik->parent])
            ->with('success', 'Data berhasil dihapus.');
    }

}


