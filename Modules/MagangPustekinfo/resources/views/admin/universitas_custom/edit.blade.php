@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item"><a href="{{ route('magangpustekinfo.admin.universitas_custom.index') }}">Universitas Custom</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
        <h4 class="main-title mb-0">Edit Universitas Custom</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('magangpustekinfo.admin.universitas_custom.update', $universitasCustom->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Universitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $universitasCustom->name) }}" 
                               placeholder="Contoh: Universitas Indonesia" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="short_name" class="form-label">Singkatan</label>
                        <input type="text" class="form-control @error('short_name') is-invalid @enderror" 
                               id="short_name" name="short_name" value="{{ old('short_name', $universitasCustom->short_name) }}" 
                               placeholder="Contoh: UI">
                        @error('short_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="group" class="form-label">Grup</label>
                        <select class="form-select @error('group') is-invalid @enderror" id="group" name="group">
                            <option value="">Pilih grup</option>
                            <option value="PTN" {{ old('group', $universitasCustom->group) == 'PTN' ? 'selected' : '' }}>PTN (Perguruan Tinggi Negeri)</option>
                            <option value="PTS" {{ old('group', $universitasCustom->group) == 'PTS' ? 'selected' : '' }}>PTS (Perguruan Tinggi Swasta)</option>
                        </select>
                        @error('group')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="university_type" class="form-label">Tipe Perguruan Tinggi</label>
                        <select class="form-select @error('university_type') is-invalid @enderror" id="university_type" name="university_type">
                            <option value="">Pilih tipe</option>
                            <option value="Universitas" {{ old('university_type', $universitasCustom->university_type) == 'Universitas' ? 'selected' : '' }}>Universitas</option>
                            <option value="Institut" {{ old('university_type', $universitasCustom->university_type) == 'Institut' ? 'selected' : '' }}>Institut</option>
                            <option value="Politeknik" {{ old('university_type', $universitasCustom->university_type) == 'Politeknik' ? 'selected' : '' }}>Politeknik</option>
                            <option value="Sekolah Tinggi" {{ old('university_type', $universitasCustom->university_type) == 'Sekolah Tinggi' ? 'selected' : '' }}>Sekolah Tinggi</option>
                            <option value="Akademi" {{ old('university_type', $universitasCustom->university_type) == 'Akademi' ? 'selected' : '' }}>Akademi</option>
                        </select>
                        @error('university_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2" 
                                  placeholder="Alamat lengkap universitas">{{ old('address', $universitasCustom->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror" 
                               id="province" name="province" value="{{ old('province', $universitasCustom->province) }}" 
                               placeholder="Contoh: DKI Jakarta">
                        @error('province')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="regency" class="form-label">Kabupaten/Kota</label>
                        <input type="text" class="form-control @error('regency') is-invalid @enderror" 
                               id="regency" name="regency" value="{{ old('regency', $universitasCustom->regency) }}" 
                               placeholder="Contoh: Kota Depok">
                        @error('regency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Status Verifikasi</label>
                    <div>
                        @if($universitasCustom->is_verified)
                            <span class="badge bg-success"><i class="ri-checkbox-circle-line"></i> Verified</span>
                        @else
                            <span class="badge bg-warning"><i class="ri-time-line"></i> Pending</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Input</label>
                    <div class="text-muted">
                        {{ $universitasCustom->created_at ? $universitasCustom->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('magangpustekinfo.admin.universitas_custom.index') }}" class="btn btn-secondary">
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


