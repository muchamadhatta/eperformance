@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Universitas</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Universitas</h4>
    </div>
    <div>
        <a href="{{ route('magangpustekinfo.admin.universitas.sync') }}" class="btn btn-primary" 
           onclick="return confirm('Sinkronisasi data universitas dari API? Proses ini mungkin memakan waktu beberapa menit.')">
            <i class="ri-refresh-line"></i> Sinkronisasi
        </a>
    </div>
</div>

<!-- Info Card -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Total Universitas</h6>
                        <h3 class="mb-0">{{ number_format($totalCount) }}</h3>
                    </div>
                    <i class="ri-building-2-line" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Terakhir Sinkronisasi</h6>
                        <h5 class="mb-0">
                            @if($lastSync)
                                {{ $lastSync->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                            @else
                                <span class="text-warning">Belum pernah</span>
                            @endif
                        </h5>
                    </div>
                    <i class="ri-time-line" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="{{ route('magangpustekinfo.admin.universitas.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               value="{{ $search ?? '' }}" placeholder="Cari nama universitas, tipe, atau lokasi...">
                        <button class="btn btn-primary" type="submit">
                            <i class="ri-search-line"></i> Cari
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per halaman</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per halaman</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per halaman</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per halaman</option>
                    </select>
                </div>
                @if($search)
                <div class="col-md-2">
                    <a href="{{ route('magangpustekinfo.admin.universitas.index') }}" class="btn btn-secondary">
                        <i class="ri-close-line"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        @if($totalCount == 0)
            <div class="alert alert-warning text-center">
                <i class="ri-information-line" style="font-size: 2rem;"></i>
                <p class="mt-2 mb-0">Belum ada data universitas. Klik tombol <strong>"Sinkronisasi"</strong> untuk mengambil data dari API.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                            <th scope="col" class="p-1 text-center">Nama</th>
                            <th scope="col" class="p-1 text-center" style="width: 8%;">Tipe</th>
                            <th scope="col" class="p-1 text-center" style="width: 8%;">Grup</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Provinsi</th>
                            <th scope="col" class="p-1 text-center" style="width: 8%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($universitas as $index => $item)
                            <tr>
                                <td class="text-center">{{ $universitas->firstItem() + $index }}</td>
                                <td>
                                    {{ $item->name }}
                                    @if($item->short_name)
                                        <small class="text-muted">({{ $item->short_name }})</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $item->university_type ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    @if($item->group == 'PTN')
                                        <span class="badge bg-success">{{ $item->group }}</span>
                                    @elseif($item->group == 'PTS')
                                        <span class="badge bg-warning">{{ $item->group }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->group ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->province ?? '-' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data yang sesuai dengan pencarian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $universitas->firstItem() ?? 0 }} - {{ $universitas->lastItem() ?? 0 }} dari {{ $universitas->total() }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $universitas->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $universitas->previousPageUrl() }}&search={{ $search }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">{{ $universitas->currentPage() }} / {{ $universitas->lastPage() }}</span>
                        </li>
                        <li class="page-item {{ !$universitas->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $universitas->nextPageUrl() }}&search={{ $search }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- Modals (outside of table) -->
@if(isset($universitas) && count($universitas) > 0)
    @foreach ($universitas as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="ri-building-2-line me-2"></i>Detail Universitas
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="ri-information-line me-1"></i>Informasi Umum
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="40%" class="text-muted">Nama</th>
                                        <td><strong>{{ $item->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Singkatan</th>
                                        <td>{{ $item->short_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tipe</th>
                                        <td>
                                            <span class="badge bg-info">{{ $item->university_type ?? '-' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Grup</th>
                                        <td>
                                            @if($item->group == 'PTN')
                                                <span class="badge bg-success">Perguruan Tinggi Negeri</span>
                                            @elseif($item->group == 'PTS')
                                                <span class="badge bg-warning">Perguruan Tinggi Swasta</span>
                                            @else
                                                {{ $item->group ?? '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="ri-map-pin-line me-1"></i>Lokasi
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="40%" class="text-muted">Alamat</th>
                                        <td>{{ $item->address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kabupaten/Kota</th>
                                        <td>{{ $item->regency ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Provinsi</th>
                                        <td>{{ $item->province ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Koordinat</th>
                                        <td>
                                            @if($item->lat && $item->long)
                                                <a href="https://www.google.com/maps?q={{ $item->lat }},{{ $item->long }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="ri-map-pin-line"></i> Lihat Peta
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection


