@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Pengusul</li>
                <li class="breadcrumb-item"><a href="{{ route('komisi.index') }}">Daftar Komisi</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Komisi</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('komisi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="komisi" class="form-label fw-bold">Komisi</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="komisi" name="komisi"
                                placeholder="Masukan Komisi" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
