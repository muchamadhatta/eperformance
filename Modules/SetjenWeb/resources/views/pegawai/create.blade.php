@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referansi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.pegawai.index') }}">Daftar Pegawai</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Pegawai </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('setjenweb.pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">Foto</label>
                            <input type="file" class="form-control w-50" id="foto" name="foto"
                                accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            placeholder="Masukan Nama" value="">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control w-50" id="email" name="email"
                            placeholder="Masukan Email" value="">

                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                        <input type="text" class="form-control w-50" id="jabatan" name="jabatan"
                            placeholder="Masukan Jabatan" value="">

                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label fw-bold">CV</label>
                            <input type="file" class="form-control w-50"
                                id="cv" name="cv" accept="application/pdf">
                    </div>


                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
