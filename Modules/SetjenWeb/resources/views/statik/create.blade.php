@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.statik.index') }}">Daftar Statik</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Statik</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.statik.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                            <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail"
                                accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="statik_id" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="statik_id" id="statik_id" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control w-50" id="kategori" name="kategori"
                            value="" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="sub_judul" class="form-label fw-bold">Sub Judul</label>
                        <input type="text" class="form-control w-50" id="sub_judul" name="sub_judul"
                            value="" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="id_menu" class="form-label fw-bold">Menu</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_menu" id="id_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($menus as $data)
                                    <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
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
