@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referansi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.jenis_dokumen.index') }}">Daftar Jenis Dokumen</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Jenis Dokumen </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('setjenweb.jenis_dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="jenis_dokumen" class="form-label fw-bold">Jenis Dokumen</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control w-50" id="jenis_dokumen" name="jenis_dokumen"
                                placeholder="Masukan Jenis Dokumen" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
