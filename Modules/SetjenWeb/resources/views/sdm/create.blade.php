@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.sdm.index') }}">Daftar Sdm</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Sdm</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.sdm.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                        <input type="text" class="form-control w-50" id="jumlah" name="jumlah"
                            value="" placeholder="Masukan Jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control w-50" id="kategori" name="kategori"
                            value="" placeholder="Masukan Kategori">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Tipe</label>
                        <select class="form-control w-50" id="type" name="type">
                            <option disabled selected>--Pilih--</option>
                            <option value="cirle"><i class="ri-pie-chart-fill"></i></option>
                            <option value="block"><i class="ri-bar-chart-2-fill"></i></option>
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Tipe</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="circle" value="circle">
                                <label class="form-check-label" for="circle">
                                    <i class="ri-pie-chart-fill"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="block" value="block">
                                <label class="form-check-label" for="block">
                                    <i class="ri-bar-chart-2-fill"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_menu" class="form-label fw-bold">Menu</label>
                            <select class="form-select w-50" name="id_menu" id="id_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($menus as $data)
                                    <option value="{{ $data->id }}" >{{ $data->judul }}</option>
                                @endforeach
                            </select>
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
