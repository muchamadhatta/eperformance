@extends('setjenweb::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Website</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Komentar</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Komentar</h4>
    </div>
    <div>
        <a href="{{ route('setjenweb.komentar.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Komentar</a>
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
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Nama</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Judul Berita</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Tanggal</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Komentar</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komentars as $komentar)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $komentar->nama }}</td>
                                <td class="text-center">
                                    @if ($komentar->id_news)
                                        @php
                                            $berita = App\Models\Setjen\Berita::find($komentar->id_news)->judul;
                                        @endphp
                                        {{ $berita }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $komentar->tanggal }}</td>
                                <td class="text-center">{{ $komentar->komentar }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.komentar.edit', $komentar->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.komentar.destroy', $komentar->id) }}" method="POST"
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
