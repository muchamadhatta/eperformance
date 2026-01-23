@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item active" aria-current="page">Universitas Custom</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Universitas Custom</h4>
    </div>
    <div>
        <a href="{{ route('magangpustekinfo.admin.universitas_custom.create') }}" class="btn btn-primary">
            <i class="ri-add-line"></i> Tambah Data
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
                        <h6 class="mb-1">Total Data</h6>
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
                        <h6 class="mb-1">Sudah Digunakan</h6>
                        <h3 class="mb-0">{{ number_format($verifiedCount) }}</h3>
                    </div>
                    <i class="ri-checkbox-circle-line" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="{{ route('magangpustekinfo.admin.universitas_custom.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               value="{{ $search ?? '' }}" placeholder="Cari nama, singkatan, atau provinsi...">
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
                    <a href="{{ route('magangpustekinfo.admin.universitas_custom.index') }}" class="btn btn-secondary">
                        <i class="ri-close-line"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        @if($totalCount == 0)
            <div class="alert alert-info text-center">
                <i class="ri-information-line" style="font-size: 2rem;"></i>
                <p class="mt-2 mb-0">Belum ada data universitas custom. Data akan muncul ketika user menambahkan universitas baru melalui form pendaftaran magang.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 4%;">No</th>
                            <th scope="col" class="p-1 text-center">Nama</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Tipe</th>
                            <th scope="col" class="p-1 text-center" style="width: 8%;">Grup</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Provinsi</th>
                            <th scope="col" class="p-1 text-center" style="width: 12%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($universitasCustom as $index => $item)
                            <tr>
                                <td class="text-center">{{ $universitasCustom->firstItem() + $index }}</td>
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
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->province ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('magangpustekinfo.admin.universitas_custom.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('magangpustekinfo.admin.universitas_custom.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
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
                    Menampilkan {{ $universitasCustom->firstItem() ?? 0 }} - {{ $universitasCustom->lastItem() ?? 0 }} dari {{ $universitasCustom->total() }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $universitasCustom->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $universitasCustom->previousPageUrl() }}&search={{ $search }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">{{ $universitasCustom->currentPage() }} / {{ $universitasCustom->lastPage() }}</span>
                        </li>
                        <li class="page-item {{ !$universitasCustom->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $universitasCustom->nextPageUrl() }}&search={{ $search }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>
@endsection


