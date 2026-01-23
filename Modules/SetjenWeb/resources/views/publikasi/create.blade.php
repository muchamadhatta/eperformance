@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.publikasi.index') }}">Daftar Publikasi</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Publikasi</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.publikasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="id_website_menu" class="form-label fw-bold">Menu</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_website_menu" id="id_website_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($website_menus as $data)
                                    <option value="{{ $data->id }}">{{ $data->param }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cover_file_name" class="form-label fw-bold">Cover Dokumen</label>
                            <input type="file" class="form-control w-50" id="cover_file_name" name="cover_file_name" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="file_name" class="form-label fw-bold">Dokumen</label>
                            <input type="file" class="form-control w-50"
                                id="file_name" name="file_name" accept="application/pdf">
                    </div>
                    <div class="mb-3">
                        <label for="id_jenis_dokumen" class="form-label fw-bold">Jenis Dokumen</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_jenis_dokumen" id="id_jenis_dokumen">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($jenis_dokumens as $data)
                                    <option value="{{ $data->id }}">{{ $data->jenis_dokumen }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-50 " id="tanggal" name="tanggal"
                            value="" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="Topik" class="form-label fw-bold">Topik</label>
                        <input type="text" class="form-control w-50" id="topik" name="topik"
                            value="" placeholder="Masukan Topik">
                    </div>
                    <div class="mb-3">
                        <label for="Penulis" class="form-label fw-bold">Penulis</label>
                        <input type="text" class="form-control w-50" id="penulis" name="penulis"
                            value="" placeholder="Masukan Penulis">
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
