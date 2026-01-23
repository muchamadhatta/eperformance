@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Pengusul</li>
                <li class="breadcrumb-item"><a href="{{ route('fraksi.index') }}">Daftar Fraksi</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Fraksi</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('fraksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="fraksi" class="form-label fw-bold">Fraksi</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="fraksi" name="fraksi"
                                placeholder="Masukan Fraksi" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
