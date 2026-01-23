@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.billboard.index') }}">Daftar Billboard</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Billboard</h4>
        </div>
    </div>
    <div class="card">
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
            <div class="mb-3">

                <form action="{{ route('setjenweb.billboard.update', $billboard->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="image_name" class="form-label fw-bold">Gambar</label>
                        @if ($billboard->image_name)
                            <br>
                            <img class="mb-3 border " src="{{ asset($billboard->image_name) }}" alt="Gambar" style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.billboard.deleteFile', ['id' => $billboard->id, 'jenis' => 'img']) }}" class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="image_name" name="image_name" accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $billboard->judul }}" placeholder="Masukan Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="sub_judul" class="form-label fw-bold">Sub Judul</label>
                        <input type="text" class="form-control w-50" id="sub_judul" name="sub_judul"
                            value="{{ $billboard->sub_judul }}" placeholder="Masukan Sub Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3" required>{{ $billboard->deskripsi }}</textarea>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
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
