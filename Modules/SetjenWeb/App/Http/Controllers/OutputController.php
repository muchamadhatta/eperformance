<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Output;
use App\Models\Setjen\WebsiteMenu;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class OutputController extends Controller
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
        $outputs = Output::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::output.index', compact('outputs'));
    }

    public function create()
    {
        $website_menus = WebsiteMenu::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::output.create', compact('website_menus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'output' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/output";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['image'] = "https://berkas.dpr.go.id/eperformance/setjen/output/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
        }

        if ($request->hasFile('materi')) {
            $file = $request->file('materi');
            $fileName = 'output' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/output";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['materi'] = "https://berkas.dpr.go.id/eperformance/setjen/output/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $output = Output::create($data);
        return redirect()->route('setjenweb.output.edit', ['id' => $output->id])
            ->with('success', 'Daftar Output berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $output = Output::findOrFail($id);
        $website_menus = WebsiteMenu::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::output.edit', compact('output', 'website_menus'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'output' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/output";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['image'] = "https://berkas.dpr.go.id/eperformance/setjen/output/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
        }

        if ($request->hasFile('materi')) {
            $file = $request->file('materi');
            $fileName = 'output' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/output";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['materi'] = "https://berkas.dpr.go.id/eperformance/setjen/output/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $output = Output::findOrFail($id);
        $output->update($data);

        return redirect()->route('setjenweb.output.index')
            ->with('success', 'Output berhasil diperbarui.');
    }

    public function deleteFile($id, $jenis)
    {
        $output = Output::findOrFail($id);

        if ($jenis === 'img' && $output->image) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $output->image);

            if (file_exists($path)) {
                unlink($path);
            }
            $output->update(['image' => null]);
            return redirect()->route('setjenweb.output.edit', $id)->with('success', 'Gambar berhasil dihapus.');
        }

        if ($jenis === 'pdf' && $output->materi) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $output->materi);

            if (file_exists($path)) {
                unlink($path);
            }
            $output->update(['materi' => null]);
            return redirect()->route('setjenweb.output.edit', $id)->with('success', 'File berhasil dihapus.');
        }

        return redirect()->route('setjenweb.output.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }



    public function destroy($id)
    {
        $output = Output::findOrFail($id);
        $output->status = 9;
        $output->save();

        return redirect()->route('setjenweb.output.index')
            ->with('success', 'Output berhasil dihapus.');
    }
}
