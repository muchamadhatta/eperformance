@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.billboard.index') }}">Daftar Billboard</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Billboard</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.billboard.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="image_name" class="form-label fw-bold">Gambar</label>
                        <input type="file" class="form-control w-50" id="image_name" name="image_name" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="sub_judul" class="form-label fw-bold">Sub Judul</label>
                        <input type="text" class="form-control w-50" id="sub_judul" name="sub_judul"
                            value="" placeholder="Masukan Sub Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3" required></textarea>
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
