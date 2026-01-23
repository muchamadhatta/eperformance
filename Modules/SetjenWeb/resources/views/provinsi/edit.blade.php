@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.provinsi.index') }}">Daftar Provinsi</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Provinsi</h4>
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

                <form action="{{ route('setjenweb.provinsi.update', $provinsi->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Provinsi</label>
                        <input type="text" class="form-control w-50" id="name" name="name"
                            placeholder="Masukan Nama Provinsi" value="{{ $provinsi->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="alt_name" class="form-label fw-bold">Nama Alias Provinsi</label>
                        <input type="text" class="form-control w-50" id="alt_name" name="alt_name"
                            placeholder="Masukan Nama Alias Provinsi" value="{{ $provinsi->alt_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label fw-bold">Latitude</label>
                        <input type="text" class="form-control w-50" id="latitude" name="latitude"
                            placeholder="Masukan Latitude" value="{{ $provinsi->latitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control w-50" id="longitude" name="longitude"
                            placeholder="Masukan Longitude" value="{{ $provinsi->longitude }}">
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
