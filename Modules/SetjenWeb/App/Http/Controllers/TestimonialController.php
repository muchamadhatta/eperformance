<?php

namespace Modules\SetjenWeb\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setjen\Testimonial;
use Illuminate\Support\Facades\File;


class TestimonialController extends Controller
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
        $testimonials = Testimonial::where('id_website', $this->id_website)->orderBy('id', 'asc')->get();
        return view('setjenweb::testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('setjenweb::testimonial.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_website'] = $this->id_website;
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            $fileName = 'pas_foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/testimonial";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['pas_foto'] = "https://berkas.dpr.go.id/eperformance/setjen/testimonial/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $testimonial = Testimonial::create($data);
        return redirect()->route('setjenweb.testimonial.edit', ['id' => $testimonial->id])
        ->with('success', 'Daftar Testimonial berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('setjenweb::testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('pas_foto')) {
            $file = $request->file('pas_foto');
            $fileName = 'pas_foto' . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "//172.16.30.157/www/eperformance/setjen/testimonial";
            move_uploaded_file($file, $path . "/" . $fileName);
            $data['pas_foto'] = "https://berkas.dpr.go.id/eperformance/setjen/testimonial/" . $fileName;
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = filesize($path . "/" . $fileName);
        }

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($data);

        return redirect()->route('setjenweb.testimonial.index')
            ->with('success', 'Daftar Testimonial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 9;
        $testimonial->save();

        return redirect()->route('setjenweb.testimonial.index')
            ->with('success', 'Testimonial berhasil dihapus.');
    }


    public function deleteFile($id, $jenis)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($jenis === 'img' && $testimonial->pas_foto) {
            $path = str_replace("https://berkas.dpr.go.id", "//172.16.30.157/www", $testimonial->pas_foto);

            if (file_exists($path)) {
                unlink($path);
            }
            $testimonial->update(['pas_foto' => null]);
            return redirect()->route('setjenweb.testimonial.edit', $id)->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->route('setjenweb.testimonial.edit', $id)->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }
}
