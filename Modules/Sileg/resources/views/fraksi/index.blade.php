@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Pengusul</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Fraksi</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Fraksi</h4>
        </div>
        <div>
            {{-- <a href="{{ route('fraksi.create') }}" class="btn btn-success">
                <i class="ri-pencil-line"></i> Tambah Fraksi
            </a> --}}
        </div>
    </div>

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
                            <th scope="col" class="p-1 text-center" style="width: 50%;">Fraksi</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fraksis as $fraksi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $fraksi->fraksi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('fraksi.edit', $fraksi->id) }}"
                                        class="btn btn-primary ">
                                        <i class="ri-edit-2-line"></i> Edit
                                    </a>
                                    {{-- <form action="{{ route('fraksi.destroy', $fraksi->id) }}"
                                        method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">
                                            <i class="ri-delete-bin-line"></i> Hapus
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
