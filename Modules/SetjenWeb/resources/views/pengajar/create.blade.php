@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referansi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.pengajar.index') }}">Daftar Pengajar</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Pengajar </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('setjenweb.pengajar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="pas_foto" class="form-label fw-bold">Foto</label>
                            <input type="file" class="form-control w-50" id="pas_foto" name="pas_foto"
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
                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <input type="text" class="form-control w-50" id="pekerjaan" name="pekerjaan"
                            placeholder="Masukan Pekerjaan" value="">

                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select w-50" name="kategori" id="kategori">
                                <option disabled selected>--Pilih--</option>
                                <option value="Widyaiswara">Widyaiswara</option>
                                <option value="Fasilitator">Fasilitator</option>
                                <option value="Narasumber">Narasumber</option>
                            </select>
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
