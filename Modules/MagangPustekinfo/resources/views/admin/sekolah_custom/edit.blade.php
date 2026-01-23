@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item"><a href="{{ route('magangpustekinfo.admin.sekolah_custom.index') }}">Sekolah Custom</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
        <h4 class="main-title mb-0">Edit Sekolah Custom</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('magangpustekinfo.admin.sekolah_custom.update', $sekolahCustom->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $sekolahCustom->name) }}" 
                               placeholder="Contoh: SMKN 1 Jakarta" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control @error('npsn') is-invalid @enderror" 
                               id="npsn" name="npsn" value="{{ old('npsn', $sekolahCustom->npsn) }}" 
                               placeholder="Contoh: 20202020">
                        @error('npsn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="grade" class="form-label">Jenjang</label>
                        <select class="form-select @error('grade') is-invalid @enderror" id="grade" name="grade">
                            <option value="">Pilih jenjang</option>
                            <option value="SD" {{ old('grade', $sekolahCustom->grade) == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('grade', $sekolahCustom->grade) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ old('grade', $sekolahCustom->grade) == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="SMK" {{ old('grade', $sekolahCustom->grade) == 'SMK' ? 'selected' : '' }}>SMK</option>
                        </select>
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">Pilih status</option>
                            <option value="N" {{ old('status', $sekolahCustom->status) == 'N' ? 'selected' : '' }}>Negeri</option>
                            <option value="S" {{ old('status', $sekolahCustom->status) == 'S' ? 'selected' : '' }}>Swasta</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2" 
                                  placeholder="Alamat lengkap sekolah">{{ old('address', $sekolahCustom->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="province_name" class="form-label">Provinsi</label>
                        <input type="text" class="form-control @error('province_name') is-invalid @enderror" 
                               id="province_name" name="province_name" value="{{ old('province_name', $sekolahCustom->province_name) }}" 
                               placeholder="Contoh: DKI Jakarta">
                        @error('province_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="regency_name" class="form-label">Kabupaten/Kota</label>
                        <input type="text" class="form-control @error('regency_name') is-invalid @enderror" 
                               id="regency_name" name="regency_name" value="{{ old('regency_name', $sekolahCustom->regency_name) }}" 
                               placeholder="Contoh: Jakarta Selatan">
                        @error('regency_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Tanggal Input</label>
                    <div class="text-muted">
                        {{ $sekolahCustom->created_at ? $sekolahCustom->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('magangpustekinfo.admin.sekolah_custom.index') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-line"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


