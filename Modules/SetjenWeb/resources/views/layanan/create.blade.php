@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.layanan.index') }}">Daftar Layanan</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Layanan</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.layanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="judul_tampil" class="form-label fw-bold">Judul Tampil</label>
                        <input type="text" class="form-control w-50" id="judul_tampil" name="judul_tampil"
                            value="" placeholder="Masukan Judul Tampil">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control w-50" id="kategori" name="kategori"
                            value="" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                        <textarea class="form-control w-50" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label fw-bold">Icon</label>
                        <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label fw-bold">Link</label>
                        <input type="text" class="form-control w-50" id="link" name="link"
                            value="" placeholder="Masukan Link">
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#datepicker5').datepicker({
            showButtonPanel: true
        });

        $('#timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    </script>
@endsection
