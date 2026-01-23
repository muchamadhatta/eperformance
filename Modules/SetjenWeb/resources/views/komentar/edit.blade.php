@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.komentar.index') }}">Daftar Komentar</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Komentar</h4>
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

                <form action="{{ route('setjenweb.komentar.update', $komentar->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                        @if ($komentar->thumbnail)
                            <br>
                            <img class="mb-3 border " src="{{ asset($komentar->thumbnail) }}" alt="Gambar"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.komentar.deleteFile', ['id' => $komentar->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail" accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="id_news" class="form-label fw-bold">Judul Berita</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_news" id="id_news">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($newss as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $komentar->id_news ? 'selected' : '' }}>{{ $data->judul }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            value="{{ $komentar->nama }}" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-15 " id="tanggal" name="tanggal"
                            value="{{ date('m/d/Y', strtotime($komentar->tanggal)) }}" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label fw-bold">Komentar</label>
                        <textarea class="form-control w-50" name="komentar" id="komentar" cols="30" rows="3">{{ $komentar->komentar }}</textarea>
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
