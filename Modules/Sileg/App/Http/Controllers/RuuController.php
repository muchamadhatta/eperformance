<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sileg\Ruu;
use App\Models\Sileg\Pembahasan_ruu;
use App\Models\Sileg\Kumulatif;
use App\Models\Sileg\Ruu_pengusul;
use App\Models\Sileg\Ruu_deskripsi_konsepsi;
use App\Models\Sileg\Ruu_riwayat;
use Illuminate\Support\Facades\File;



class RuuController extends Controller
{
    public function index()
    {
        $ruus = Ruu::where('status', 1)->orderBy('id', 'desc')->get();
        return view('sileg::ruu.index', compact('ruus'));
    }

    public function create()
    {
        $pembahasan_ruu = Pembahasan_ruu::all();
        return view('sileg::ruu.create', compact('pembahasan_ruu'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal_pengusulan'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_pengusulan)->format('Y-m-d');
        $data['pengusul'] = implode(', ', $request->pengusul);

        $ruu = Ruu::create($data);

        return redirect()->route('ruu.edit', ['id' => $ruu->id])
            ->with('success', 'Daftar RUU berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ruu = Ruu::findOrFail($id);
        $pembahasan_ruu = Pembahasan_ruu::where('status', 1)->orderBy('id', 'asc')->get();
        $kumulatif = Kumulatif::where('status', 1)->orderBy('id', 'asc')->get();
        $ruu_pengusuls = Ruu_pengusul::where('status', 1)->where('id_ruu', $id)->orderBy('id', 'asc')->get();
        $ruu_deskripsi_konsepsis = Ruu_deskripsi_konsepsi::where('status', 1)->where('id_ruu', $id)->orderBy('id', 'asc')->get();
        $ruu_riwayats = Ruu_riwayat::where('status', 1)->where('id_ruu', $id)->orderBy('no_urut_prioritas', 'asc')->get();

        return view('sileg::ruu.edit', compact('ruu', 'pembahasan_ruu', 'kumulatif', 'ruu_pengusuls', 'ruu_deskripsi_konsepsis', 'ruu_riwayats'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['tanggal_pengusulan'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_pengusulan)->format('Y-m-d');
        $data['pengusul'] = implode(', ', $request->pengusul);

        $ruu = Ruu::findOrFail($id);
        $ruu->update($data);

        return redirect()->route('ruu.index')
            ->with('success', 'Daftar RUU berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruu = Ruu::findOrFail($id);
        $ruu->status = 9;
        $ruu->save();

        return redirect()->route('ruu.index')
            ->with('success', 'RUU berhasil dihapus.');
    }


    //ruu pengusul
    public function store_ruu_pengusul(Request $request)
    {
        $data = $request->all();
        $data['id_ruu'] = $request->id_ruu;

        $ruu_pengusul = Ruu_pengusul::create($data);

        return redirect()->route('ruu.edit', ['id' => $request->id_ruu])
            ->with('success', 'Daftar Pengusul berhasil ditambahkan.');
    }


    public function update_ruu_pengusul(Request $request, $id)
    {
        $data = $request->all();

        $ruu_pengusul = Ruu_pengusul::findOrFail($id);
        $ruu_pengusul->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_pengusul->id_ruu])
            ->with('success', 'Daftar Pengusul berhasil diperbarui.');
    }
    public function destroy_ruu_pengusul($id)
    {
        $ruu_pengusul = Ruu_pengusul::findOrFail($id);
        $ruu_pengusul->status = 9;
        $ruu_pengusul->save();

        return redirect()->route('ruu.edit', ['id' => $ruu_pengusul->id_ruu])
            ->with('success', 'Pengusul berhasil dihapus.');
    }


    //ruu deskripsi_konsepsi
    public function store_ruu_deskripsi_konsepsi(Request $request)
    {
        $data = $request->all();
        $data['id_ruu'] = $request->id_ruu;
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = 'file_pdf' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('berkas_sileg/ruu_deskripsi_konsepsi/'), $fileName);
            $filePath = 'berkas_sileg/ruu_deskripsi_konsepsi/' . $fileName;

            $fileSize = filesize($filePath);

            $data['file_type'] = $file->getClientMimeType();
            $data['file_name'] = $fileName;
            $data['file_size'] = $fileSize;
        }

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::create($data);

        return redirect()->route('ruu.edit', ['id' => $request->id_ruu])
            ->with('success', 'Daftar Deskripsi Konsepsi berhasil ditambahkan.');
    }


    public function update_ruu_deskripsi_konsepsi(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $fileName = 'file_pdf' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('berkas_sileg/ruu_deskripsi_konsepsi/'), $fileName);
            $filePath = 'berkas_sileg/ruu_deskripsi_konsepsi/' . $fileName;
            $fileSize = filesize($filePath);

            $data['file_type'] = $file->getClientMimeType();
            $data['file_name'] = $fileName;
            $data['file_size'] = $fileSize;
        }

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Daftar Deskripsi Konsepsi berhasil diperbarui.');
    }


    public function deleteFile_ruu_deskripsi_konsepsi($id, $jenis)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        if ($jenis === 'pdf' && $ruu_deskripsi_konsepsi->file_name) {
            File::delete(public_path('berkas_sileg/ruu_deskripsi_konsepsi/' . $ruu_deskripsi_konsepsi->file_name));
            $ruu_deskripsi_konsepsi->update(['file_name' => null]);
            return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'File berhasil dihapus.');
        }
        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
        ->with('error', 'Tidak ada tindakan penghapusan yang dilakukan.');

    }
    public function destroy_ruu_deskripsi_konsepsi($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->status = 9;
        $ruu_deskripsi_konsepsi->save();

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Deskripsi Konsepsi berhasil dihapus.');
    }

    public function edit_ruu_deskripsi_konsepsi_latar_belakang($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        return view('sileg::ruu.edit_latar_belakang', compact('ruu_deskripsi_konsepsi'));
    }


    public function update_ruu_deskripsi_konsepsi_latar_belakang(Request $request, $id)
    {
        $data = $request->all();
        $data['latar_belakang'] = strip_tags($data['latar_belakang']);

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Latar Belakang Deskripsi Konsepsi berhasil diperbarui.');
    }

    public function edit_ruu_deskripsi_konsepsi_sasaran($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        return view('sileg::ruu.edit_sasaran', compact('ruu_deskripsi_konsepsi'));
    }


    public function update_ruu_deskripsi_konsepsi_sasaran(Request $request, $id)
    {
        $data = $request->all();
        $data['sasaran'] = strip_tags($data['sasaran']);

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Sasaran Deskripsi Konsepsi berhasil diperbarui.');
    }

    public function edit_ruu_deskripsi_konsepsi_jangkauan($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        return view('sileg::ruu.edit_jangkauan', compact('ruu_deskripsi_konsepsi'));
    }


    public function update_ruu_deskripsi_konsepsi_jangkauan(Request $request, $id)
    {
        $data = $request->all();
        $data['jangkauan'] = strip_tags($data['jangkauan']);

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Jangkauan Konsepsi berhasil diperbarui.');
    }

    public function edit_ruu_deskripsi_konsepsi_dasar_pembentukan($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        return view('sileg::ruu.edit_dasar_pembentukan', compact('ruu_deskripsi_konsepsi'));
    }


    public function update_ruu_deskripsi_konsepsi_dasar_pembentukan(Request $request, $id)
    {
        $data = $request->all();
        $data['dasar_pembentukan'] = strip_tags($data['dasar_pembentukan']);

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Dasar Pembentukan Konsepsi berhasil diperbarui.');
    }

    public function edit_ruu_deskripsi_konsepsi_sejarah_ruu($id)
    {
        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);

        return view('sileg::ruu.edit_sejarah_ruu', compact('ruu_deskripsi_konsepsi'));
    }


    public function update_ruu_deskripsi_konsepsi_sejarah_ruu(Request $request, $id)
    {
        $data = $request->all();
        $data['sejarah_ruu'] = strip_tags($data['sejarah_ruu']);

        $ruu_deskripsi_konsepsi = Ruu_deskripsi_konsepsi::findOrFail($id);
        $ruu_deskripsi_konsepsi->update($data);

        return redirect()->route('ruu.edit', ['id' => $ruu_deskripsi_konsepsi->id_ruu])
            ->with('success', 'Sejarah RUU Konsepsi berhasil diperbarui.');
    }

}
