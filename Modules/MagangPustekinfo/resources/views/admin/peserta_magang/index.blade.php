@extends('magangpustekinfo::layouts.app')

@php
use Illuminate\Support\Str;

$title = 'Daftar Peserta';
if ($status) {
    $title .= ' - ' . $status;
} elseif (isset($tingkatPendidikan) && $tingkatPendidikan) {
    $title .= ' - ' . $tingkatPendidikan;
} elseif (isset($jenisMagang) && $jenisMagang) {
    $title .= ' - Magang ' . $jenisMagang;
} else {
    $title .= ' Magang';
}
@endphp

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Magang</li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $title }}
            </li>
        </ol>
        <h4 class="main-title mb-0">
            {{ $title }}
        </h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('magangpustekinfo.admin.peserta_magang.export') }}" class="btn btn-info">
            <i class="ri-file-excel-2-line"></i> Export Excel
        </a>
        <a href="{{ route('magangpustekinfo.admin.peserta_magang.create') }}" class="btn btn-success">
            <i class="ri-add-line"></i> Tambah Peserta Magang
        </a>
    </div>
</div>

<div class="card ">
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="visibility: hidden;">
                <thead>
                    <tr>
                        <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                        <th scope="col" class="p-1 text-center" style="width: 20%;">Nama Lengkap</th>
                        <th scope="col" class="p-1 text-center" style="width: 15%;">Project</th>
                        <th scope="col" class="p-1 text-center" style="width: 10%;">Jenis Magang</th>
                        <th scope="col" class="p-1 text-center" style="width: 15%;">Tingkat Pendidikan</th>
                        <th scope="col" class="p-1 text-center" style="width: 15%;">Durasi</th>
                        <th scope="col" class="p-1 text-center" style="width: 15%;">Mentor</th>
                        <th scope="col" class="p-1 text-center" style="width: 10%;">Status</th>
                        <th scope="col" class="p-1 text-center" style="width: 10%;">Status Permohonan</th>
                        <th scope="col" class="p-1 text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertaMagangs as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $item->kategori_project }}</span>
                                <br>
                                <small>{{ $item->tugas }}</small>
                            </td>






                            <td class="text-center">
                                @if($item->jenis_magang == 'Hub')
                                    <span class="badge bg-primary">Hub</span>
                                @elseif($item->jenis_magang == 'Mandiri')
                                    <span class="badge bg-secondary">Mandiri</span>
                                @else
                                    <span class="badge bg-light text-dark">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <strong>{{ $item->tingkat_pendidikan }}</strong><br>
                                <small>{{ $item->nama_sekolah }}</small>
                            </td>

                            <td class="text-center">
                                <small>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                                </small><br>
                                <small>
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}
                                </small>
                            </td>
                            <td>{{ $item->mentor }}</td>

                            <td class="text-center">
                                @if($item->status == 'Belum Dimulai')
                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                @elseif($item->status == 'Dalam Proses')
                                    <span class="badge bg-primary">{{ $item->status }}</span>
                                @elseif($item->status == 'Selesai')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status_permohonan == 'Diterima')
                                    <span class="badge bg-success">{{ $item->status_permohonan }}</span>
                                @elseif($item->status_permohonan == 'Ditolak')
                                    <span class="badge bg-danger">{{ $item->status_permohonan }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('magangpustekinfo.admin.peserta_magang.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="ri-edit-2-line"></i> Edit
                                </a>
                                <form action="{{ route('magangpustekinfo.admin.peserta_magang.destroy', $item->id) }}" method="POST" style="display: inline-block" class="form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus">
                                        <i class="ri-delete-bin-line"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show success message if exists
        var sessionSuccess = "{{ session('success') }}";
        
        if(sessionSuccess){
            Swal.fire({
                title: 'Berhasil!',
                text: sessionSuccess,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }

        // Use event delegation for dynamically loaded content
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush


