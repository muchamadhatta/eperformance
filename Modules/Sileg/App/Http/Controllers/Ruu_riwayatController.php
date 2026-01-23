<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Ruu_riwayat;
use App\Models\Sileg\Ruu;
use App\Models\Sileg\Periode_prolegnas;


class Ruu_riwayatController extends Controller
{
    // public function index()
    // {
    //     $ruu_riwayats = Ruu_riwayat::where('status', 1)->orderBy('id', 'desc')->get();
    //     return view('ruu_riwayat.index', compact('ruu_riwayats'));
    // }

    public function index()
    {
        // Ambil semua data ruu_riwayat yang statusnya 1, kemudian urutkan berdasarkan tahun dan revisi
        $ruu_riwayats = Ruu_riwayat::where('status', 1)->orderBy('tahun')->get();

        // Variabel untuk menyimpan baris unik berdasarkan tahun dan revisi
        $tahun_revisis = collect();

        // Loop melalui hasil yang diperoleh
        foreach ($ruu_riwayats as $ruu_riwayat) {
            // Buat kunci unik berdasarkan tahun dan revisi
            $key = $ruu_riwayat->tahun . '-' . $ruu_riwayat->revisi;

            // Jika baris dengan kunci yang sama belum ditambahkan, tambahkan ke koleksi
            if (!$tahun_revisis->has($key)) {
                $tahun_revisis->put($key, $ruu_riwayat);
            }
        }

        // Kembalikan tampilan dengan data unik
        return view('sileg::ruu_riwayat.index', compact('tahun_revisis'));
    }


    public function create()
    {
        $prolegnass = Periode_prolegnas::where('status', 1)->get();
        $ruus = Ruu::where('status', 1)->get();
        return view('sileg::ruu_riwayat.create', compact('prolegnass', 'ruus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_ruu'] = array_values($data['id_ruu']);
        $data['no_urut_prioritas'] = array_values($data['no_urut_prioritas']);
        $data['judul_ruu_prioritas'] = array_values($data['judul_ruu_prioritas']);
        $data['pengusul_prioritas'] = array_values($data['pengusul_prioritas']);

        // Hapus nilai-nilai 0 dari array no_urut_prioritas
        // $data["no_urut_prioritas"] = array_filter($data["no_urut_prioritas"]);
        // dd($data);
        // Tambahkan nilai tahun dan revisi ke dalam array
        $jumlah_data = count($data["id_ruu"]);
        $data["id_periode_prolegnas"] = array_fill(0, $jumlah_data, $data["id_periode_prolegnas"]);
        $data["tahun"] = array_fill(0, $jumlah_data, $data["tahun"]);
        $data["revisi"] = array_fill(0, $jumlah_data, $data["revisi"]);

        // Buat array untuk menyimpan data yang akan disimpan ke dalam database
        $data_to_store = [];

        // Gabungkan data ke dalam array untuk disimpan ke dalam database
        for ($i = 0; $i < $jumlah_data; $i++) {
            $data_to_store[] = [
                'id_ruu' => $data['id_ruu'][$i],
                'judul_ruu_prioritas' => $data['judul_ruu_prioritas'][$i],
                'pengusul_prioritas' => $data['pengusul_prioritas'][$i],
                'id_periode_prolegnas' => $data['id_periode_prolegnas'][$i],
                'no_urut_prioritas' => $data['no_urut_prioritas'][$i],
                'tahun' => $data['tahun'][$i],
                'revisi' => $data['revisi'][$i],
            ];
        }


        // Simpan data ke dalam database
        foreach ($data_to_store as $data) {

            Ruu_riwayat::create($data);
        }

        return redirect()->route('ruu_riwayat.edit', ['tahun' => $data['tahun'], 'revisi' => $data['revisi']])
            ->with('success', 'Daftar RUU Riwayat berhasil ditambahkan.');

    }


    // public function edit($id)
    // {
    //     $ruu_riwayat = Ruu_riwayat::findOrFail($id);
    //     $ruus = Ruu::where('status', 1)
    //         ->where('id_ruu_riwayat', $ruu_riwayat->id)
    //         ->orderBy('id', 'desc')
    //         ->get();

    //     return view('ruu_riwayat.edit', compact('ruu_riwayat', 'ruus'));
    // }

    public function edit($tahun, $revisi)
    {
        $ruu_riwayat = Ruu_riwayat::where('tahun', $tahun)
            ->where('revisi', $revisi)
            ->firstOrFail();

        $ruu_prioritass = Ruu_riwayat::where('status', 1)
            ->where('tahun', $tahun)
            ->where('revisi', $revisi)
            ->orderBy('no_urut_prioritas', 'asc')
            ->get();

        return view('sileg::ruu_riwayat.edit', compact('ruu_riwayat', 'ruu_prioritass'));
    }


    public function update_ruu_prioritas(Request $request, $tahun, $revisi)
    {
        $data = $request->all();
        foreach ($data['id_ruu_riwayat'] as $id) {

            $ruu_riwayat = Ruu_riwayat::findOrFail($id);

            $ruu_riwayat->judul_ruu_prioritas = $data['judul_ruu_prioritas'][$id];
            $ruu_riwayat->no_urut_prioritas = $data['no_urut_prioritas'][$id];
            $ruu_riwayat->pengusul_prioritas = $data['pengusul_prioritas'][$id];

            $ruu_riwayat->save();
        }

        return redirect()->route('ruu_riwayat.index')
            ->with('success', 'Daftar RUU Prioritas berhasil diperbarui.');
    }



    public function destroy_ruu_prioritas(Request $request, $tahun, $revisi)
    {
        $ids = $request->input('hapus_ids');

        $string = implode(',', $ids);
        $idsArray = explode(',', $string);

        foreach ($idsArray as $id) {
            $ruu_prioritas = Ruu_riwayat::findOrFail($id);
            $ruu_prioritas->status = 9;
            $ruu_prioritas->save();
        }

        return redirect()->route('ruu_riwayat.edit', ['tahun' => $tahun, 'revisi' => $revisi])
            ->with('success', 'Daftar RUU Prioritas berhasil dihapus.');
    }


    public function create_ruu_prioritas($tahun, $revisi, $id_periode_prolegnas)
    {
        $ruu_riwayat = Ruu_riwayat::where('tahun', $tahun)
            ->where('revisi', $revisi)
            ->where('id_periode_prolegnas', $id_periode_prolegnas)
            ->firstOrFail();

        $ruus = Ruu::where('status', 1)->get();
        $prolegnass = Periode_prolegnas::where('status', 1)->get();

        return view('ruu_riwayat.create_ruu_prioritas', compact('ruu_riwayat', 'ruus', 'prolegnass'));
    }



    // public function update(Request $request, $id)
    // {
    //     $data = $request->all();

    //     $ruu_riwayat = Ruu_riwayat::findOrFail($id);
    //     $ruu_riwayat->update($data);

    //     return redirect()->route('ruu_riwayat.index')
    //         ->with('success', 'Daftar RUU Riwayat berhasil diperbarui.');
    // }

    public function destroy($id)
    {
        $ruu_riwayat = Ruu_riwayat::findOrFail($id);
        $ruu_riwayat->status = 9;
        $ruu_riwayat->save();

        return redirect()->route('ruu_riwayat.index')
            ->with('success', 'RUU Riwayat berhasil dihapus.');
    }


    public function destroy_prioritas(Request $request, $tahun, $revisi)
    {

        Ruu_riwayat::where('tahun', $tahun)
            ->where('revisi', $revisi)
            ->update(['status' => 9]);

        return redirect()->route('ruu_riwayat.index')
            ->with('success', 'RUU Riwayat berhasil dihapus.');
    }

}
