@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referansi</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.tujuan_agenda.index') }}">Daftar Tujuan Agenda</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Tujuan Agenda </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('setjenweb.tujuan_agenda.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="tujuan_agenda" class="form-label fw-bold">Tujuan Agenda</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control w-50" id="tujuan_agenda" name="tujuan_agenda"
                                placeholder="Masukan Tujuan Agenda" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label fw-bold">Icon</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="icon" id="icon">
                                <option disabled selected>--Pilih--</option>
                                <option value="agenda">Agenda</option>
                                <option value="sidang">Sidang</option>
                                <option value="reses">Reses</option>
                                <option value="dwi-mingguan">Dwi Mingguan</option>
                            </select>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
