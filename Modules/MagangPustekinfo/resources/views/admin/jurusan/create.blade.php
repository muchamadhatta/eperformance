@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item"><a href="{{ route('magangpustekinfo.admin.jurusan.index') }}">Jurusan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
        <h4 class="main-title mb-0">Tambah Jurusan</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('magangpustekinfo.admin.jurusan.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Contoh: Sistem Informasi" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="">Pilih level</option>
                            <option value="SMA" {{ old('level') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="SMK" {{ old('level') == 'SMK' ? 'selected' : '' }}>SMK</option>
                            <option value="D3" {{ old('level') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4" {{ old('level') == 'D4' ? 'selected' : '' }}>D4</option>
                            <option value="S1" {{ old('level') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('level') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('level') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="faculty" class="form-label">Fakultas</label>
                        <input type="text" class="form-control @error('faculty') is-invalid @enderror" 
                               id="faculty" name="faculty" value="{{ old('faculty') }}" 
                               placeholder="Contoh: Fakultas Ilmu Komputer">
                        @error('faculty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('magangpustekinfo.admin.jurusan.index') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-line"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


