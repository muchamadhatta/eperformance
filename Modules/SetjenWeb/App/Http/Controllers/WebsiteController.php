<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Website;
use Illuminate\Support\Facades\File;


class WebsiteController extends Controller
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
        $websites = Website::Where('id', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::website.index', compact('websites'));
    }


    public function edit($id)
    {
        $website = Website::findOrFail($id);
        $identitas = json_decode($website->identitas, true);
        $sosmed = json_decode($website->sosmed, true);
        $banner = json_decode($website->banner, true);
        return view('setjenweb::website.edit', compact('website', 'identitas', 'sosmed', 'banner'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $logo = $data['identitas']['logo'] ;
        if ($request->hasFile('identitas.logo')) {
            $file = $request->file('identitas.logo');
            $fileName = 'logo' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = "//172.16.30.157/www/eperformance/setjen/website";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['identitas']['logo'] = "https://berkas.dpr.go.id/eperformance/setjen/website/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }else{
            $data['identitas']['logo'] = $logo;
        }

        $identitas = $data['identitas'] ?? [];
        $data['identitas'] = json_encode($identitas);
        $sosmed = $data['sosmed'] ?? [];
        $data['sosmed'] = json_encode($sosmed);
        $banner = $data['banner'] ?? [];
        $data['banner'] = json_encode($banner);

        $website = Website::findOrFail($id);
        $website->update($data);

        return redirect()->route('setjenweb.website.index')
            ->with('success', 'Daftar Website berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $website = Website::findOrFail($id);
        $website->status = 9;
        $website->save();

        return redirect()->route('setjenweb.website.index')
            ->with('success', 'Website berhasil dihapus.');
    }


    public function deleteFile($id, $jenis)
    {
        $website = Website::findOrFail($id);

        $identitas = json_decode($website->identitas, true);
        if ($jenis === 'img' && isset($identitas['logo'])) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $identitas['logo']);

            if (file_exists($path)) {
                unlink($path);
            }
            $identitas['logo'] = null;
            $website->update(['identitas' => json_encode($identitas)]);
            return redirect()->route('setjenweb.website.edit', $id)->with('success', 'Logo berhasil dihapus.');
        }

        return redirect()->route('setjenweb.galeri.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }
}
