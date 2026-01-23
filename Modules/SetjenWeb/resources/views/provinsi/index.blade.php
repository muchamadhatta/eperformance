@extends('setjenweb::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Provinsi</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Provinsi</h4>
    </div>
    <div>
        <a href="{{ route('setjenweb.provinsi.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Provinsi</a>
    </div>
</div><!-- row -->
    <div class="card ">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('success-alert').remove();
                    }, 3000);
                </script>
            @endif

            <div class="table-responsive">
                <table id="tableGrid3">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Provinsi</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinsis as $provinsi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $provinsi->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.provinsi.edit', $provinsi->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.provinsi.destroy', $provinsi->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                            Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div><!-- table-responsive -->
        </div><!-- card-body -->

    </div>
@endsection
