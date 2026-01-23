<?php

namespace Modules\MagangPustekinfo\App\Services;

use Modules\MagangPustekinfo\App\Models\PesertaMagangModel;
use Modules\MagangPustekinfo\App\Models\JurusanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesertaMagangService
{
    protected $pesertaMagangModel;

    public function __construct(PesertaMagangModel $pesertaMagangModel)
    {
        $this->pesertaMagangModel = $pesertaMagangModel;
    }


    public function getAllActivePesertaMagang($status = null, $jenisMagang = null, $tingkatPendidikan = null)
    {
        $this->checkAndUpdateStatus();

        $query = $this->pesertaMagangModel->where('is_active', 1);

        if ($status) {
            $query->where('status', $status);
        }

        if ($jenisMagang) {
            $query->where('jenis_magang', $jenisMagang);
        }

        if ($tingkatPendidikan) {
            $query->where('tingkat_pendidikan', $tingkatPendidikan);
        }

        return $query->orderBy('id', 'desc')
            ->get();
    }

    public function getDashboardStats()
    {
        $this->checkAndUpdateStatus();

        $activeQuery = $this->pesertaMagangModel->where('is_active', 1);

        return [
            'total_peserta' => (clone $activeQuery)->count(),
            'total_magang' => (clone $activeQuery)->where('tingkat_pendidikan', 'Magang')->count(), // Kuliah
            'total_pkl' => (clone $activeQuery)->where('tingkat_pendidikan', 'PKL')->count(), // Sekolah
            'total_hub' => (clone $activeQuery)->where('jenis_magang', 'Hub')->count(),
            'total_mandiri' => (clone $activeQuery)->where('jenis_magang', 'Mandiri')->count(),
            'status_permohonan' => (clone $activeQuery)->where('status', 'Permohonan')->count(),
            'status_belum_mulai' => (clone $activeQuery)->where('status', 'Belum Dimulai')->count(),
            'status_dalam_proses' => (clone $activeQuery)->where('status', 'Dalam Proses')->count(),
            'status_selesai' => (clone $activeQuery)->where('status', 'Selesai')->count(),
        ];
    }

    public function getRecentPeserta($limit = 5)
    {
        return $this->pesertaMagangModel->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public function checkAndUpdateStatus()
    {
        $today = now()->format('Y-m-d');

        // 1. FORWARD: 'Belum Dimulai' -> 'Dalam Proses' if start date has arrived
        $this->pesertaMagangModel->where('is_active', 1)
            ->where('status', 'Belum Dimulai')
            ->where('tanggal_mulai', '<=', $today)
            ->where(function($q) use ($today) {
                $q->where('tanggal_selesai', '>=', $today)
                  ->orWhereNull('tanggal_selesai');
            })
            ->update(['status' => 'Dalam Proses']);

        // 2. FORWARD: 'Dalam Proses' -> 'Selesai' if end date has passed
        $this->pesertaMagangModel->where('is_active', 1)
            ->where('status', 'Dalam Proses')
            ->where('tanggal_selesai', '<', $today)
            ->update(['status' => 'Selesai']);

        // 3. REVERSE: 'Selesai' -> 'Dalam Proses' if end date is manipulated back to future/present
        $this->pesertaMagangModel->where('is_active', 1)
            ->where('status', 'Selesai')
            ->where('tanggal_selesai', '>=', $today)
            ->update(['status' => 'Dalam Proses']);

        // 4. REVERSE: 'Dalam Proses' -> 'Belum Dimulai' if start date is manipulated back to future
        $this->pesertaMagangModel->where('is_active', 1)
            ->where('status', 'Dalam Proses')
            ->where('tanggal_mulai', '>', $today)
            ->update(['status' => 'Belum Dimulai']);
    }

    public function createPesertaMagang(array $data)
    {
        if (isset($data['jurusan'])) {
            $data['jurusan'] = Str::title(trim($data['jurusan']));
            $this->ensureJurusanExists($data['jurusan'], $data['tingkat_pendidikan'] ?? null);
        }
        return $this->pesertaMagangModel->create($data);
    }


    public function getPesertaMagangById($id)
    {
        return $this->pesertaMagangModel->findOrFail($id);
    }


    public function updatePesertaMagang($id, array $data)
    {
        $pesertaMagang = $this->pesertaMagangModel->findOrFail($id);
        if (isset($data['jurusan'])) {
            $data['jurusan'] = Str::title(trim($data['jurusan']));
            $this->ensureJurusanExists($data['jurusan'], $data['tingkat_pendidikan'] ?? $pesertaMagang->tingkat_pendidikan);
        }
        $pesertaMagang->update($data);
        return $pesertaMagang;
    }

    protected function ensureJurusanExists($name, $tingkatPendidikan)
    {
        if (empty($name)) return;

        // Try to find exact match
        $exists = JurusanModel::where('name', $name)->exists();

        if (!$exists) {
            // Determine default level based on tingkat_pendidikan
            $level = null;
            if ($tingkatPendidikan === 'Magang') {
                $level = 'S1'; // Default to S1 for Magang
            } elseif ($tingkatPendidikan === 'PKL') {
                $level = 'SMK'; // Default to SMK for PKL
            }

            JurusanModel::create([
                'name' => $name,
                'level' => $level,
                'faculty' => null
            ]);
        }
    }


    public function deletePesertaMagang($id)
    {
        $pesertaMagang = $this->pesertaMagangModel->findOrFail($id);
        $pesertaMagang->is_active = 0;
        $pesertaMagang->save();
        return $pesertaMagang;
    }


    public function validatePesertaMagangData(Request $request)
    {
        return $request->validate([
            'kategori_project' => 'required|in:Aplikasi,Data Analitik,Infrastruktur,Keamanan',
            'jenis_magang' => 'required|in:Hub,Mandiri',
            'tugas' => 'required|string',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'username_github' => 'nullable|string|max:100',
            'tingkat_pendidikan' => 'required|in:PKL,Magang',
            'nama_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'semester' => 'nullable|integer|min:1|max:14',
            'status' => 'required|in:Belum Dimulai,Dalam Proses,Selesai,Permohonan',
            'status_permohonan' => 'nullable|in:Diterima,Ditolak',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'catatan' => 'nullable|string',
            'mentor' => 'nullable|string',
        ]);
    }
}
