@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori Project</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Kategori Project</h4>
    </div>
    <div>
        <a href="{{ route('magangpustekinfo.admin.kategori_project.create') }}" class="btn btn-primary">
            <i class="ri-add-line"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="card ">
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                        <th scope="col" class="p-1 text-center">Nama Kategori</th>
                        <th scope="col" class="p-1 text-center">Deskripsi</th>
                        <th scope="col" class="p-1 text-center">Icon</th>
                        <th scope="col" class="p-1 text-center">Status</th>
                        <th scope="col" class="p-1 text-center" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description ?? '-' }}</td>
                            <td class="text-center">
                                @if($item->icon)
                                    <i class="{{ $item->icon }} fs-5"></i>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ route('magangpustekinfo.admin.kategori_project.toggle', $item->id) }}" method="POST" id="toggle-form-{{ $item->id }}">
                                    @csrf
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" role="switch" 
                                            onchange="document.getElementById('toggle-form-{{ $item->id }}').submit()" 
                                            {{ $item->is_active ? 'checked' : '' }} 
                                            title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    </div>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('magangpustekinfo.admin.kategori_project.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="ri-edit-2-line"></i> Edit
                                </a>
                                <form action="{{ route('magangpustekinfo.admin.kategori_project.destroy', $item->id) }}" method="POST"
style="display: inline-block" class="form-hapus">
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
        // Jika datatable belum diinit, init
        if (!$.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').DataTable();
        }

        $('.btn-hapus').on('click', function(e) {
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


