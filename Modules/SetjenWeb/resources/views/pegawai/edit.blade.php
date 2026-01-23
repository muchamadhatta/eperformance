@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.pegawai.index') }}">Daftar Pegawai</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Pegawai</h4>
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
                <form action="{{ route('setjenweb.pegawai.update', $pegawai->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">Foto</label>
                        @if ($pegawai->foto)
                            <br>
                            <img class="mb-3 border " src="{{ asset($pegawai->foto) }}" alt="Foto"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.pegawai.deleteFile', ['id' => $pegawai->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="foto" name="foto"
                                accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            placeholder="Masukan Nama" value="{{ $pegawai->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control w-50" id="email" name="email"
                            placeholder="Masukan Email" value="{{ $pegawai->email }}">

                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                        <input type="text" class="form-control w-50" id="jabatan" name="jabatan"
                            placeholder="Masukan Jabatan" value="{{ $pegawai->jabatan }}">

                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3">{{ $pegawai->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label fw-bold">CV</label>

                        @if ($pegawai->cv)
                            <br>
                            <a href="{{ asset($pegawai->cv) }}" target="_blank"
                                class="btn btn-warning "><i class="ri-file-line"></i>
                                Tampilkan CV</a>

                            <a href="#" class="btn btn-success">
                                <i class="ri-file-line"></i>
                                {{ ceil($pegawai->file_size / 1024) }} KB
                            </a>

                            <a href="{{ route('setjenweb.pegawai.deleteFile', ['id' => $pegawai->id, 'jenis' => 'pdf']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                Hapus CV</a>
                        @else
                            <input type="file" class="form-control w-50"
                                id="cv" name="cv" accept="application/pdf">
                        @endif
                    </div>


                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
