@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.provinsi.index') }}">Daftar Provinsi</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Provinsi</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.provinsi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Provinsi</label>
                        <input type="text" class="form-control w-50" id="name" name="name"
                            placeholder="Masukan Nama Provinsi" value="">
                    </div>
                    <div class="mb-3">
                        <label for="alt_name" class="form-label fw-bold">Nama Alias Provinsi</label>
                        <input type="text" class="form-control w-50" id="alt_name" name="alt_name"
                            placeholder="Masukan Nama Alias Provinsi" value="">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label fw-bold">Latitude</label>
                        <input type="text" class="form-control w-50" id="latitude" name="latitude"
                            placeholder="Masukan Latitude" value="">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control w-50" id="longitude" name="longitude"
                            placeholder="Masukan Longitude" value="">
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
