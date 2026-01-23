@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.output.index') }}">Daftar Output</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Output</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.output.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="image" class="form-label fw-bold">Image</label>
                            <input type="file" class="form-control w-50" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label fw-bold">Materi</label>
                            <input type="file" class="form-control w-50"
                                id="materi" name="materi" accept="application/pdf">
                    </div>

                    <div class="mb-3">
                        <label for="rekaman" class="form-label fw-bold">Link Rekaman</label>
                        <textarea class="form-control w-50" name="rekaman" id="rekaman" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input type="text" class="form-control w-50 datepicker5" id="tanggal" name="tanggal"
                            value="" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label fw-bold">Tag</label>
                        <input type="text" class="form-control w-50" id="tag" name="tag"
                            value="" placeholder="Masukan Tag">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                        <input type="text" class="form-control w-50" id="lokasi" name="lokasi"
                            value="" placeholder="Masukan Lokasi">
                    </div>

                    <div class="mb-3">
                        <label for="mulai" class="form-label fw-bold">Waktu Mulai</label>
                        <input  type="text" class="form-control w-15 timepicker" id="mulai" name="mulai"
                            value="" placeholder="Pilih Waktu Mulai">
                    </div>
                    <div class="mb-3">
                        <label for="selesai" class="form-label fw-bold">Waktu Selesai</label>
                        <input  type="text" class="form-control w-15 timepicker" id="selesai" name="selesai"
                            value="" placeholder="Pilih Waktu Selesai">
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.datepicker5').datepicker({
            showButtonPanel: true
        });

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    </script>
@endsection
