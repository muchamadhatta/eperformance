@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Berita</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Berita</h4>
        </div>
        <div>
            <a href="{{ route('setjenweb.berita.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Berita</a>
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
                            <th scope="col" class="p-1 text-center" style="width: 5%;"></th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Tanggal</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $berita->judul }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($berita->tanggal)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.berita.edit', $berita->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.berita.destroy', $berita->id) }}" method="POST"
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
