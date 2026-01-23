@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.testimonial.index') }}">Daftar Testimonial</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Testimonial</h4>
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
                <form action="{{ route('setjenweb.testimonial.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="pas_foto" class="form-label fw-bold">Foto</label>
                        @if ($testimonial->pas_foto)
                            <br>
                            <img class="mb-3 border " src="{{ asset($testimonial->pas_foto) }}" alt="Foto"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.testimonial.deleteFile', ['id' => $testimonial->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="pas_foto" name="pas_foto"
                                accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            placeholder="Masukan Nama" value="{{ $testimonial->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            placeholder="Masukan Judul" value="{{ $testimonial->judul }}">
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <input type="text" class="form-control w-50" id="pekerjaan" name="pekerjaan"
                            placeholder="Masukan Pekerjaan" value="{{ $testimonial->pekerjaan }}">
                    </div>
                    <div class="mb-3">
                        <label for="testimoni" class="form-label fw-bold">Testimoni</label>
                        <textarea class="form-control w-50" name="testimoni" id="testimoni" cols="30" rows="3">{{ $testimonial->testimoni }}</textarea>
                    </div>
                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
