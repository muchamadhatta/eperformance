<?php

namespace Modules\MagangPustekinfo\App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Modules\MagangPustekinfo\App\Services\PesertaMagangService;



class PesertaMagangController extends Controller
{
    protected $pesertaMagangService;

    public function __construct(PesertaMagangService $pesertaMagangService)
    {
        $this->pesertaMagangService = $pesertaMagangService;
    }


    public function index(Request $request)
    {
        $status = $request->query('status');
        $jenisMagang = $request->query('jenis_magang');
        $tingkatPendidikan = $request->query('tingkat_pendidikan');
        $pesertaMagangs = $this->pesertaMagangService->getAllActivePesertaMagang($status, $jenisMagang, $tingkatPendidikan);
        return view('magangpustekinfo::admin.peserta_magang.index', compact('pesertaMagangs', 'status', 'jenisMagang', 'tingkatPendidikan'));
    }

    public function create()
    {
        return view('magangpustekinfo::admin.peserta_magang.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->pesertaMagangService->validatePesertaMagangData($request);
            $pesertaMagang = $this->pesertaMagangService->createPesertaMagang($validatedData);
            Alert::success('Berhasil', 'Daftar Peserta Magang berhasil ditambahkan.');
            return redirect()->route('magangpustekinfo.admin.peserta_magang.edit', ['id' => $pesertaMagang->id]);
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $pesertaMagang = $this->pesertaMagangService->getPesertaMagangById($id);
            return view('magangpustekinfo::admin.peserta_magang.edit', compact('pesertaMagang'));

        } catch (\Exception $e) {
            return redirect()->route('magangpustekinfo.admin.peserta_magang.index')
                ->with('error', 'Data peserta magang tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->pesertaMagangService->validatePesertaMagangData($request);
            $this->pesertaMagangService->updatePesertaMagang($id, $validatedData);
            Alert::success('Berhasil', 'Daftar Peserta Magang berhasil diperbarui.');
            return redirect()->route('magangpustekinfo.admin.peserta_magang.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->pesertaMagangService->deletePesertaMagang($id);
            Alert::success('Berhasil', 'Peserta Magang berhasil dihapus.');
            return redirect()->route('magangpustekinfo.admin.peserta_magang.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data.');
            return redirect()->route('magangpustekinfo.admin.peserta_magang.index');
        }
    }

    /**
     * Export data peserta magang ke Excel
     */
    public function exportExcel()
    {
        $pesertaMagangs = $this->pesertaMagangService->getAllActivePesertaMagang();
        
        $filename = 'peserta_magang_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($pesertaMagangs) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header row
            fputcsv($file, [
                'No',
                'Nama Lengkap',
                'Email',
                'No. HP',
                'Username GitHub',
                'Jenis Program',
                'Nama Sekolah/Kampus',
                'Jurusan',
                'Semester',
                'Kategori Project',
                'Jenis Magang',
                'Status',
                'Status Permohonan',
                'Tanggal Mulai',
                'Tanggal Selesai',
                'Tugas',
                'Catatan',
                'Tanggal Input'
            ], ';');
            
            // Data rows
            $no = 1;
            foreach ($pesertaMagangs as $item) {
                fputcsv($file, [
                    $no++,
                    $item->nama_lengkap,
                    $item->email,
                    $item->nomor_handphone,
                    $item->username_github ?? '-',
                    $item->tingkat_pendidikan,
                    $item->nama_sekolah,
                    $item->jurusan,
                    $item->semester ?? '-',
                    $item->kategori_project,
                    $item->jenis_magang ?? '-',
                    $item->status,
                    $item->status_permohonan ?? '-',
                    $item->tanggal_mulai ? $item->tanggal_mulai->format('d/m/Y') : '-',
                    $item->tanggal_selesai ? $item->tanggal_selesai->format('d/m/Y') : '-',
                    $item->tugas ?? '-',
                    $item->catatan ?? '-',
                    $item->tanggal_input ? date('d/m/Y H:i', strtotime($item->tanggal_input)) : '-'
                ], ';');
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
