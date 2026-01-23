<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\AduanWbs;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;



class AduanWbsController extends Controller
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
        $aduan_wbss = AduanWbs::where('status', 1)->where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::aduan_wbs.index', compact('aduan_wbss'));
    }

    public function create()
    {

        return view('setjenweb::aduan_wbs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = 'aduan_wbs' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/aduan_wbs";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['dokumen'] = "https://berkas.dpr.go.id/eperformance/setjen/aduan_wbs/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $aduan_wbs = AduanWbs::create($data);
        return redirect()->route('setjenweb.aduan_wbs.edit', ['id' => $aduan_wbs->id])
            ->with('success', 'Daftar AduanWbs berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $aduan_wbs = AduanWbs::findOrFail($id);
        return view('setjenweb::aduan_wbs.edit', compact('aduan_wbs'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = 'aduan_wbs' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/aduan_wbs";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['dokumen'] = "https://berkas.dpr.go.id/eperformance/setjen/aduan_wbs/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $aduan_wbs = AduanWbs::findOrFail($id);
        $aduan_wbs->update($data);

        return redirect()->route('setjenweb.aduan_wbs.index')
            ->with('success', 'AduanWbs berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $aduan_wbs = AduanWbs::findOrFail($id);

        if ($jenis === 'img' && $aduan_wbs->dokumen) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $aduan_wbs->dokumen);

            if (file_exists($path)) {
                unlink($path);
            }
            $aduan_wbs->update(['dokumen' => null]);
            return redirect()->route('setjenweb.aduan_wbs.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->route('setjenweb.aduan_wbs.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $aduan_wbs = AduanWbs::findOrFail($id);
        $aduan_wbs->status = 9;
        $aduan_wbs->save();

        return redirect()->route('setjenweb.aduan_wbs.index')
            ->with('success', 'AduanWbs berhasil dihapus.');
    }
}
