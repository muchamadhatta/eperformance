<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Ruu_longlist;
use App\Models\Sileg\Ruu;
use App\Models\Sileg\Periode_prolegnas;


class Ruu_longlistController extends Controller
{


    public function index()
    {
        // Ambil semua data ruu_longlist yang statusnya 1, kemudian urutkan berdasarkan periode prolegnas dan revisi
        $ruu_longlists = Ruu_longlist::where('status', 1)->orderBy('id_periode_prolegnas')->get();

        // Variabel untuk menyimpan baris unik berdasarkan periode prolegnas dan revisi
        $prolegnas_revisis = collect();

        // Loop melalui hasil yang diperoleh
        foreach ($ruu_longlists as $ruu_longlist) {
            // Buat kunci unik berdasarkan periode prolegnas dan revisi
            $key = $ruu_longlist->id_periode_prolegnas . '-' . $ruu_longlist->revisi;

            // Jika baris dengan kunci yang sama belum ditambahkan, tambahkan ke koleksi
            if (!$prolegnas_revisis->has($key)) {
                $prolegnas_revisis->put($key, $ruu_longlist);
            }
        }

        // Kembalikan tampilan dengan data unik
        return view('sileg::ruu_longlist.index', compact('prolegnas_revisis'));
    }


    public function create()
    {
        $prolegnass = Periode_prolegnas::where('status', 1)->get();
        $ruus = Ruu::where('status', 1)->get();
        return view('sileg::ruu_longlist.create', compact('prolegnass', 'ruus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_ruu'] = array_values($data['id_ruu']);
        $data['no_urut_longlist'] = array_values($data['no_urut_longlist']);
        $data['judul_ruu_longlist'] = array_values($data['judul_ruu_longlist']);
        $data['pengusul_longlist'] = array_values($data['pengusul_longlist']);

        // Hapus nilai-nilai 0 dari array no_urut_longlist
        // $data["no_urut_longlist"] = array_filter($data["no_urut_longlist"]);
        // dd($data);
        // Tambahkan nilai tahun dan revisi ke dalam array
        $jumlah_data = count($data["id_ruu"]);
        $data["id_periode_prolegnas"] = array_fill(0, $jumlah_data, $data["id_periode_prolegnas"]);
        $data["revisi"] = array_fill(0, $jumlah_data, $data["revisi"]);

        // Buat array untuk menyimpan data yang akan disimpan ke dalam database
        $data_to_store = [];

        // Gabungkan data ke dalam array untuk disimpan ke dalam database
        for ($i = 0; $i < $jumlah_data; $i++) {
            $data_to_store[] = [
                'id_ruu' => $data['id_ruu'][$i],
                'judul_ruu_longlist' => $data['judul_ruu_longlist'][$i],
                'pengusul_longlist' => $data['pengusul_longlist'][$i],
                'id_periode_prolegnas' => $data['id_periode_prolegnas'][$i],
                'no_urut_longlist' => $data['no_urut_longlist'][$i],
                'revisi' => $data['revisi'][$i],
            ];
        }


        // Simpan data ke dalam database
        foreach ($data_to_store as $data) {

            Ruu_longlist::create($data);
        }

        return redirect()->route('ruu_longlist.edit', ['id_periode_prolegnas' => $data['id_periode_prolegnas'], 'revisi' => $data['revisi']])
            ->with('success', 'Daftar RUU Riwayat Longlist berhasil ditambahkan.');

    }


    // public function edit($id)
    // {
    //     $ruu_longlist = Ruu_longlist::findOrFail($id);
    //     $ruus = Ruu::where('status', 1)
    //         ->where('id_ruu_longlist', $ruu_longlist->id)
    //         ->orderBy('id', 'desc')
    //         ->get();

    //     return view('ruu_longlist.edit', compact('ruu_longlist', 'ruus'));
    // }

    public function edit($id_periode_prolegnas, $revisi)
    {
        $ruu_longlist = Ruu_longlist::where('id_periode_prolegnas', $id_periode_prolegnas)
            ->where('revisi', $revisi)
            ->firstOrFail();

        $ruu_longlists = Ruu_longlist::where('status', 1)
            ->where('id_periode_prolegnas', $id_periode_prolegnas)
            ->where('revisi', $revisi)
            ->orderBy('no_urut_longlist', 'asc')
            ->get();

        $prolegnass = Periode_prolegnas::where('status', 1)->get();


        return view('sileg::ruu_longlist.edit', compact('ruu_longlist', 'ruu_longlists', 'prolegnass'));
    }


    public function update_ruu_longlist(Request $request, $tahun, $revisi)
    {
        $data = $request->all();
        foreach ($data['id_ruu_longlist'] as $id) {

            $ruu_longlist = Ruu_longlist::findOrFail($id);

            $ruu_longlist->judul_ruu_longlist = $data['judul_ruu_longlist'][$id];
            $ruu_longlist->no_urut_longlist = $data['no_urut_longlist'][$id];
            $ruu_longlist->pengusul_longlist = $data['pengusul_longlist'][$id];

            $ruu_longlist->save();
        }

        return redirect()->route('ruu_longlist.index')
            ->with('success', 'Daftar RUU Longlist berhasil diperbarui.');
    }



    public function destroy_ruu_longlist(Request $request, $id_periode_prolegnas, $revisi)
    {
        $ids = $request->input('hapus_ids');

        $string = implode(',', $ids);
        $idsArray = explode(',', $string);

        foreach ($idsArray as $id) {
            $ruu_longlist = Ruu_longlist::findOrFail($id);
            $ruu_longlist->status = 9;
            $ruu_longlist->save();
        }

        return redirect()->route('ruu_longlist.edit', ['id_periode_prolegnas' => $id_periode_prolegnas, 'revisi' => $revisi])
            ->with('success', 'Daftar RUU Longlist berhasil dihapus.');
    }


    public function create_ruu_longlist($id_periode_prolegnas, $revisi)
    {
        $ruu_longlist = Ruu_longlist::where('id_periode_prolegnas', $id_periode_prolegnas)
            ->where('revisi', $revisi)
            ->firstOrFail();

        $ruus = Ruu::where('status', 1)->get();
        $prolegnass = Periode_prolegnas::where('status', 1)->get();

        return view('sileg::ruu_longlist.create_ruu_longlist', compact('ruu_longlist', 'ruus', 'prolegnass'));
    }



    // public function update(Request $request, $id)
    // {
    //     $data = $request->all();

    //     $ruu_longlist = Ruu_longlist::findOrFail($id);
    //     $ruu_longlist->update($data);

    //     return redirect()->route('ruu_longlist.index')
    //         ->with('success', 'Daftar RUU Riwayat berhasil diperbarui.');
    // }

    public function destroy($id)
    {
        $ruu_longlist = Ruu_longlist::findOrFail($id);
        $ruu_longlist->status = 9;
        $ruu_longlist->save();

        return redirect()->route('ruu_longlist.index')
            ->with('success', 'RUU Riwayat Longlist berhasil dihapus.');
    }


    public function destroy_longlist(Request $request, $id_periode_prolegnas, $revisi)
    {

        Ruu_longlist::where('id_periode_prolegnas', $id_periode_prolegnas)
            ->where('revisi', $revisi)
            ->update(['status' => 9]);

        return redirect()->route('ruu_riwayat.index')
            ->with('success', 'RUU Riwayat Longlist berhasil dihapus.');
    }
}
