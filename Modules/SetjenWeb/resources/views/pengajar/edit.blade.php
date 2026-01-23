@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.pengajar.index') }}">Daftar Pengajar</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Pengajar</h4>
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
                <form action="{{ route('setjenweb.pengajar.update', $pengajar->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label for="pas_foto" class="form-label fw-bold">Foto</label>
                        @if ($pengajar->pas_foto)
                            <br>
                            <img class="mb-3 border " src="{{ asset($pengajar->pas_foto) }}" alt="Foto"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.pengajar.deleteFile', ['id' => $pengajar->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="pas_foto" name="pas_foto"
                                accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            placeholder="Masukan Nama" value="{{ $pengajar->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control w-50" id="email" name="email"
                            placeholder="Masukan Email" value="{{ $pengajar->email }}">

                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <input type="text" class="form-control w-50" id="pekerjaan" name="pekerjaan"
                            placeholder="Masukan Pekerjaan" value="{{ $pengajar->pekerjaan }}">

                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select w-50" name="kategori" id="kategori">
                                <option value="Widyaiswara" {{ $pengajar->kategori == 'Widyaiswara' ? 'selected' : '' }}>Widyaiswara</option>
                                <option value="Fasilitator" {{ $pengajar->kategori == 'Fasilitator' ? 'selected' : '' }}>Fasilitator</option>
                                <option value="Narasumber" {{ $pengajar->kategori == 'Narasumber' ? 'selected' : '' }}>Narasumber</option>
                            </select>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
