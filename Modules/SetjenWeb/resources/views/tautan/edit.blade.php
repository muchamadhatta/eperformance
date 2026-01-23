@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.tautan.index') }}">Daftar Tautan</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Tautan</h4>
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

                <form action="{{ route('setjenweb.tautan.update', $tautan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $tautan->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label fw-bold">Link</label>
                        <input type="text" class="form-control w-50" id="link" name="link"
                            value="{{ $tautan->link }}" placeholder="Masukan Jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label fw-bold">Jenis</label>
                        <input type="text" class="form-control w-50" id="jenis" name="jenis"
                            value="{{ $tautan->jenis }}" placeholder="Masukan Jenis">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3">{{ $tautan->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file_name" class="form-label fw-bold">Icon</label>
                        <textarea class="form-control w-50" name="file_name" id="file_name" cols="30" rows="3">{{ $tautan->file_name }}</textarea>
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
