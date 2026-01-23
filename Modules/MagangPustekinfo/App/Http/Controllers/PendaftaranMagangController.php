<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\PesertaMagangService;
use Modules\MagangPustekinfo\App\Models\KategoriProjectModel;

class PendaftaranMagangController extends Controller
{
    protected $pesertaMagangService;

    public function __construct(PesertaMagangService $pesertaMagangService)
    {
        $this->pesertaMagangService = $pesertaMagangService;
    }



    /**
     * Menampilkan halaman form pendaftaran magang
     */
    public function index()
    {
        $kategori_project = KategoriProjectModel::active()->ordered()->get();
        return view('magangpustekinfo::public.daftar-magang.index', compact('kategori_project'));
    }

    /**
     * Menyimpan data pendaftaran magang
     */
    public function store(Request $request)
    {
        // Get valid categories names
        $validCategories = KategoriProjectModel::active()->pluck('name')->toArray();
        $categoriesString = implode(',', $validCategories);

        // Education fields are required only for Mandiri (students still in school)
        $isHub = $request->input('jenis_magang') === 'Hub';

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'username_github' => 'nullable|string|max:100',
            'tingkat_pendidikan' => $isHub ? 'nullable|in:PKL,Magang' : 'required|in:PKL,Magang',
            'nama_sekolah' => $isHub ? 'nullable|string|max:255' : 'required|string|max:255',
            'jurusan' => $isHub ? 'nullable|string|max:255' : 'required|string|max:255',
            'semester' => 'nullable|integer|min:1|max:14',
            'kategori_project' => 'required|string|in:' . $categoriesString,
            'jenis_magang' => 'required|in:Hub,Mandiri',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tugas' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Set default values untuk pendaftaran publik
        $validated['status'] = 'Permohonan';
        $validated['tugas'] = $validated['tugas'] ?? 'Menunggu penugasan';

        try {
            $this->pesertaMagangService->createPesertaMagang($validated);
            return redirect()->route('magangpustekinfo.daftar_magang.success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan halaman sukses setelah pendaftaran
     */
    public function success()
    {
        return view('magangpustekinfo::public.daftar-magang.success');
    }
}
