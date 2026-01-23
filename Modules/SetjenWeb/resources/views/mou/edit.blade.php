@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.mou.index') }}">Daftar MOU</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit MOU</h4>
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

                <form action="{{ route('setjenweb.mou.update', $mou->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            value="{{ $mou->nama }}" placeholder="Masukan Nama">
                    </div>

                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label fw-bold">Provinsi</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_provinsi" id="id_provinsi">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($provinsis as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $mou->id_provinsi ? 'selected' : '' }}>{{ $data->name }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label fw-bold">Logo</label>
                        @if ($mou->logo)
                            <br>
                            <img class="mb-3 border " src="{{ asset($mou->logo) }}" alt="logo" style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.mou.deleteFile', ['id' => $mou->id, 'jenis' => 'img']) }}" class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="logo" name="logo" accept="image/*">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label fw-bold">Materi</label>

                        @if ($mou->materi)
                            <br>
                            <a href="{{ asset($mou->materi) }}" target="_blank"
                                class="btn btn-warning "><i class="ri-file-line"></i>
                                Tampilkan Materi</a>

                            <a href="#" class="btn btn-success">
                                <i class="ri-file-line"></i>
                                {{ ceil($mou->file_size / 1024) }} KB
                            </a>

                            <a href="{{ route('setjenweb.mou.deleteFile', ['id' => $mou->id, 'jenis' => 'pdf']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                Hapus Materi</a>
                        @else
                            <input type="file" class="form-control w-50"
                                id="materi" name="materi" accept="application/pdf">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="id_dokumen" class="form-label fw-bold">Dokumen</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_dokumen" id="id_dokumen">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($dokumens as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $mou->id_dokumen ? 'selected' : '' }}>{{ $data->judul }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
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
