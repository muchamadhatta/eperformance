@extends('magangpustekinfo::layouts.app')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <h4 class="main-title mb-0">Overview Pustekinfo Internship</h4>
        </div>
        <div class="d-none d-md-flex gap-2">
            <span class="text-secondary fs-sm d-flex align-items-center"><i class="ri-calendar-line me-1"></i> {{ date('d F Y') }}</span>
        </div>
    </div>

    <!-- MAIN STATS ROW -->
    <div class="row g-3 mb-4">
        <!-- Total Peserta -->
        <div class="col-6 col-md-3">
            <a href="{{ route('magangpustekinfo.admin.peserta_magang.index') }}" class="text-decoration-none">
                <div class="card card-one shadow-sm border-0 h-100 card-hover effect-purple">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <label class="card-title fs-sm fw-medium mb-1 text-muted">Total Peserta Aktif</label>
                                <h2 class="card-value mb-1 text-dark">{{ number_format($stats['total_peserta']) }}</h2>
                                <small class="text-success fw-medium"><i class="ri-arrow-up-line"></i> Active</small>
                            </div>
                            <div class="avatar avatar-sm bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-team-line fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Magang -->
        <div class="col-6 col-md-3">
            <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['tingkat_pendidikan' => 'Magang']) }}" class="text-decoration-none">
                <div class="card card-one shadow-sm border-0 h-100 card-hover effect-cyan">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start">
                             <div>
                                <label class="card-title fs-sm fw-medium mb-1 text-muted">Mahasiswa Magang</label>
                                <h2 class="card-value mb-1 text-dark">{{ number_format($stats['total_magang']) }}</h2>
                                <small class="text-secondary">Universitas</small>
                            </div>
                            <div class="avatar avatar-sm bg-info-subtle text-info rounded-circle">
                                <i class="ri-graduation-cap-line fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- PKL -->
        <div class="col-6 col-md-3">
             <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['tingkat_pendidikan' => 'PKL']) }}" class="text-decoration-none">
                <div class="card card-one shadow-sm border-0 h-100 card-hover effect-orange">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start">
                             <div>
                                <label class="card-title fs-sm fw-medium mb-1 text-muted">Siswa PKL</label>
                                <h2 class="card-value mb-1 text-dark">{{ number_format($stats['total_pkl']) }}</h2>
                                <small class="text-secondary">SMK / Sekolah</small>
                            </div>
                            <div class="avatar avatar-sm bg-warning-subtle text-warning rounded-circle">
                                <i class="ri-school-line fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Permohonan -->
        <div class="col-6 col-md-3">
             <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Permohonan']) }}" class="text-decoration-none">
                <div class="card card-one shadow-sm border-0 h-100 card-hover effect-red">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start">
                             <div>
                                <label class="card-title fs-sm fw-medium mb-1 text-muted">Permohonan Baru</label>
                                <h2 class="card-value mb-1 text-dark">{{ number_format($stats['status_permohonan']) }}</h2>
                                <small class="{{ $stats['status_permohonan'] > 0 ? 'text-danger fw-bold' : 'text-secondary' }}">Need Verification</small>
                            </div>
                            <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle">
                                <i class="ri-file-list-3-line fs-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- MIDDLE ROW: RECENT ACTIVITY & STATUS -->
    <div class="row g-3">
        <!-- Recent Applicants -->
        <div class="col-md-8">
            <div class="card card-one shadow-sm border-0">
                <div class="card-header border-0 bg-transparent py-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0 fs-6">Pendaftar Terbaru</h6>
                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index') }}" class="fs-xs fw-medium text-primary text-decoration-none">Lihat Semua <i class="ri-arrow-right-line"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3 py-2 fs-xs text-secondary text-uppercase fw-semibold">Nama</th>
                                    <th class="py-2 fs-xs text-secondary text-uppercase fw-semibold">Institusi</th>
                                    <th class="py-2 fs-xs text-secondary text-uppercase fw-semibold">Jurusan</th>
                                    <th class="py-2 fs-xs text-secondary text-uppercase fw-semibold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPeserta as $peserta)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs bg-secondary-subtle text-secondary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <span class="fs-xs fw-bold">{{ substr($peserta->nama_lengkap, 0, 1) }}</span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="fs-sm fw-medium text-dark">{{ Str::limit($peserta->nama_lengkap, 20) }}</span>
                                                    <span class="fs-xs text-secondary">{{ $peserta->tingkat_pendidikan }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fs-sm text-dark">{{ Str::limit($peserta->nama_sekolah, 20) }}</span></td>
                                        <td><span class="fs-sm text-dark">{{ Str::limit($peserta->jurusan, 20) }}</span></td>
                                        <td class="text-center">
                                            @php
                                                $badgeClass = match($peserta->status) {
                                                    'Selesai' => 'bg-success-subtle text-success',
                                                    'Dalam Proses' => 'bg-primary-subtle text-primary',
                                                    'Belum Dimulai' => 'bg-secondary-subtle text-secondary',
                                                    'Permohonan' => 'bg-warning-subtle text-warning',
                                                    default => 'bg-light text-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} border-0 fw-normal">{{ $peserta->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-secondary fs-sm">Belum ada data pendaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Summary & Filters -->
        <div class="col-md-4">
            <div class="row g-3">
                <!-- Status Cards -->
                 <div class="col-12">
                     <div class="card shadow-sm border-0 h-100">
                        <div class="card-header border-0 bg-transparent py-3">
                            <h6 class="card-title mb-0 fs-6">Status Peserta</h6>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush border-0">
                                <!-- Belum Mulai -->
                                <li class="list-group-item border-0 px-3 py-3 d-flex align-items-center justify-content-between hover-bg-gray-100">
                                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Belum Dimulai']) }}" class="text-decoration-none w-100 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-secondary-subtle text-secondary rounded-2"><i class="ri-time-line fs-5"></i></div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark fs-sm">Belum Dimulai</h6>
                                                <small class="text-secondary text-xs">Waiting to start</small>
                                            </div>
                                        </div>
                                        <span class="fs-5 fw-bold text-dark">{{ $stats['status_belum_mulai'] }}</span>
                                    </a>
                                </li>

                                <!-- Sedang Berjalan -->
                                <li class="list-group-item border-top border-0 px-3 py-3 d-flex align-items-center justify-content-between hover-bg-gray-100">
                                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Dalam Proses']) }}" class="text-decoration-none w-100 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-primary-subtle text-primary rounded-2"><i class="ri-loader-4-line fs-5"></i></div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark fs-sm">Sedang Berjalan</h6>
                                                <small class="text-secondary text-xs">Active Internship</small>
                                            </div>
                                        </div>
                                        <span class="fs-5 fw-bold text-dark">{{ $stats['status_dalam_proses'] }}</span>
                                    </a>
                                </li>

                                <!-- Selesai -->
                                <li class="list-group-item border-top border-0 px-3 py-3 d-flex align-items-center justify-content-between hover-bg-gray-100">
                                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Selesai']) }}" class="text-decoration-none w-100 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-success-subtle text-success rounded-2"><i class="ri-checkbox-circle-line fs-5"></i></div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark fs-sm">Selesai</h6>
                                                <small class="text-secondary text-xs">Finished Program</small>
                                            </div>
                                        </div>
                                        <span class="fs-5 fw-bold text-dark">{{ $stats['status_selesai'] }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                     </div>
                 </div>

                 <!-- Jenis Magang Mini Cards -->
                 <div class="col-6">
                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['jenis_magang' => 'Hub']) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 card-hover text-center p-3 h-100">
                             <div class="avatar avatar-sm bg-primary-subtle text-primary rounded-circle mx-auto mb-2">
                                <i class="ri-links-line"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark">{{ $stats['total_hub'] }}</h5>
                            <span class="fs-xs text-secondary">Magang Hub</span>
                        </div>
                    </a>
                 </div>
                  <div class="col-6">
                    <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['jenis_magang' => 'Mandiri']) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 card-hover text-center p-3 h-100">
                             <div class="avatar avatar-sm bg-secondary-subtle text-secondary rounded-circle mx-auto mb-2">
                                <i class="ri-user-star-line"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark">{{ $stats['total_mandiri'] }}</h5>
                            <span class="fs-xs text-secondary">Mandiri</span>
                        </div>
                    </a>
                 </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        }
        .effect-purple { border-bottom: 3px solid #6f42c1; }
        .effect-cyan { border-bottom: 3px solid #0dcaf0; }
        .effect-orange { border-bottom: 3px solid #fd7e14; }
        .effect-red { border-bottom: 3px solid #dc3545; }
        
        .transition-all { transition: all 0.2s; }
        .hover-bg-gray-200:hover { background-color: #e9ecef !important; }
        .hover-bg-gray-100:hover { background-color: #f8f9fa !important; }
    </style>
    @endpush
@endsection

