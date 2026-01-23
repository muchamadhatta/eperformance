@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referansi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.testimonial.index') }}">Daftar Testimonial</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Testimonial </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('setjenweb.testimonial.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            placeholder="Masukan Judul" value="">
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <input type="text" class="form-control w-50" id="pekerjaan" name="pekerjaan"
                            placeholder="Masukan Pekerjaan" value="">
                    </div>
                    <div class="mb-3">
                        <label for="testimoni" class="form-label fw-bold">Testimoni</label>
                        <textarea class="form-control w-50" name="testimoni" id="testimoni" cols="30" rows="3"></textarea>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
