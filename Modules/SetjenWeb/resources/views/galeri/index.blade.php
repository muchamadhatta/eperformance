@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Galeri</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Galeri</h4>
        </div>
        <div>
            <a href="{{ route('setjenweb.galeri.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah
                Galeri</a>
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
                <table  id="tableGrid3">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Thumbnail Galeri</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeris as $galeri)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    @if ($galeri->thumbnail_name)
                                        <img src="{{ asset($galeri->thumbnail_name) }}" alt="Album"
                                            style="max-width: 100px; max-height: 100px;">
                                    @endif
                                </td>
                                <td class="text-center">{{ $galeri->judul }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.galeri.edit', $galeri->id) }}" class="btn btn-primary m-1"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.galeri.destroy', $galeri->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-1"><i class="ri-delete-bin-line"></i>
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
