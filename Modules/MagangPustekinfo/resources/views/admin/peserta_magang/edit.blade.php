@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item">Data Magang</li>
            <li class="breadcrumb-item"><a href="{{ route('magangpustekinfo.admin.peserta_magang.index') }}">Daftar Peserta Magang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Peserta Magang</li>
        </ol>
        <h4 class="main-title mb-0">Edit Peserta Magang</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('magangpustekinfo.admin.peserta_magang.update', $pesertaMagang->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Data Pribadi --}}
            <h5 class="mb-3">Data Pribadi</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                           id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $pesertaMagang->nama_lengkap) }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $pesertaMagang->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nomor_handphone" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nomor_handphone') is-invalid @enderror" 
                           id="nomor_handphone" name="nomor_handphone" value="{{ old('nomor_handphone', $pesertaMagang->nomor_handphone) }}" required>
                    @error('nomor_handphone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="username_github" class="form-label">Username GitHub</label>
                    <input type="text" class="form-control @error('username_github') is-invalid @enderror" 
                           id="username_github" name="username_github" value="{{ old('username_github', $pesertaMagang->username_github) }}">
                    @error('username_github')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <hr class="my-4">
            
            {{-- Data Pendidikan --}}
            <h5 class="mb-3">Data Pendidikan</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tingkat_pendidikan" class="form-label">Jenis Program <span class="text-danger">*</span></label>
                    <select class="form-select @error('tingkat_pendidikan') is-invalid @enderror" 
                            id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                        <option value="">-- Pilih Jenis Program --</option>
                        <option value="Magang" {{ old('tingkat_pendidikan', $pesertaMagang->tingkat_pendidikan) == 'Magang' ? 'selected' : '' }}>Magang (Kuliah)</option>
                        <option value="PKL" {{ old('tingkat_pendidikan', $pesertaMagang->tingkat_pendidikan) == 'PKL' ? 'selected' : '' }}>PKL (SMA/SMK)</option>
                    </select>
                    @error('tingkat_pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="nama_sekolah" class="form-label">
                        <span id="label_institusi">Nama Sekolah/Kampus</span> 
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('nama_sekolah') is-invalid @enderror" 
                            id="nama_sekolah" name="nama_sekolah" required style="width: 100%;">
                        @if($pesertaMagang->nama_sekolah)
                            <option value="{{ $pesertaMagang->nama_sekolah }}" selected>{{ $pesertaMagang->nama_sekolah }}</option>
                        @endif
                    </select>
                    @error('nama_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted" id="hint_institusi">Ketik minimal 2 huruf untuk mencari</small>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                    <select class="form-select @error('jurusan') is-invalid @enderror" 
                            id="jurusan" name="jurusan" required style="width: 100%;">
                        @if(old('jurusan', $pesertaMagang->jurusan))
                            <option value="{{ old('jurusan', $pesertaMagang->jurusan) }}" selected>{{ old('jurusan', $pesertaMagang->jurusan) }}</option>
                        @endif
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="semester" class="form-label">Semester/Kelas</label>
                    <input type="number" class="form-control @error('semester') is-invalid @enderror" 
                           id="semester" name="semester" value="{{ old('semester', $pesertaMagang->semester) }}" min="1" max="14">
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <hr class="my-4">
            
            {{-- Data Magang --}}
            <h5 class="mb-3">Data Magang</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jenis_magang" class="form-label">Jenis Magang <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis_magang') is-invalid @enderror" 
                            id="jenis_magang" name="jenis_magang" required>
                        <option value="">-- Pilih Jenis Magang --</option>
                        <option value="Hub" {{ old('jenis_magang', $pesertaMagang->jenis_magang) == 'Hub' ? 'selected' : '' }}>Hub (Kerjasama Institusi)</option>
                        <option value="Mandiri" {{ old('jenis_magang', $pesertaMagang->jenis_magang) == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                    </select>
                    @error('jenis_magang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="kategori_project" class="form-label">Kategori Project <span class="text-danger">*</span></label>
                    <select class="form-select @error('kategori_project') is-invalid @enderror" 
                            id="kategori_project" name="kategori_project" required>
                        <option value="">-- Pilih Kategori Project --</option>
                        <option value="Aplikasi" {{ old('kategori_project', $pesertaMagang->kategori_project) == 'Aplikasi' ? 'selected' : '' }}>Aplikasi</option>
                        <option value="Data Analitik" {{ old('kategori_project', $pesertaMagang->kategori_project) == 'Data Analitik' ? 'selected' : '' }}>Data Analitik</option>
                        <option value="Infrastruktur" {{ old('kategori_project', $pesertaMagang->kategori_project) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="Keamanan" {{ old('kategori_project', $pesertaMagang->kategori_project) == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                    </select>
                    @error('kategori_project')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Permohonan" {{ old('status', $pesertaMagang->status) == 'Permohonan' ? 'selected' : '' }}>Permohonan</option>
                        <option value="Belum Dimulai" {{ old('status', $pesertaMagang->status) == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                        <option value="Dalam Proses" {{ old('status', $pesertaMagang->status) == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="Selesai" {{ old('status', $pesertaMagang->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="tugas" class="form-label">Tugas <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('tugas') is-invalid @enderror" 
                              id="tugas" name="tugas" rows="3" required>{{ old('tugas', $pesertaMagang->tugas) }}</textarea>
                    @error('tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status_permohonan" class="form-label">Status Permohonan</label>
                    <select class="form-select @error('status_permohonan') is-invalid @enderror" 
                            id="status_permohonan" name="status_permohonan">
                        <option value="">-- Pilih Status Permohonan --</option>
                        <option value="Diterima" {{ old('status_permohonan', $pesertaMagang->status_permohonan) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ old('status_permohonan', $pesertaMagang->status_permohonan) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status_permohonan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pesertaMagang->tanggal_mulai ? $pesertaMagang->tanggal_mulai->format('Y-m-d') : '') }}">
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pesertaMagang->tanggal_selesai ? $pesertaMagang->tanggal_selesai->format('Y-m-d') : '') }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="mentor" class="form-label">Mentor</label>
                    <textarea class="form-control @error('mentor') is-invalid @enderror" 
                              id="mentor" name="mentor" rows="3">{{ old('mentor', $pesertaMagang->mentor) }}</textarea>
                    @error('mentor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                              id="catatan" name="catatan" rows="3">{{ old('catatan', $pesertaMagang->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="ri-save-line"></i> Simpan
                </button>
                <a href="{{ route('magangpustekinfo.admin.peserta_magang.index') }}" class="btn btn-secondary">
                    <i class="ri-arrow-left-line"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
    .select2-container--bootstrap-5 .select2-selection {
        min-height: 38px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        let currentType = '{{ $pesertaMagang->tingkat_pendidikan }}';
        
        // Initialize Select2
        $('#nama_sekolah').select2({
            theme: 'bootstrap-5',
            placeholder: 'Ketik untuk mencari...',
            allowClear: true,
            minimumInputLength: 2,
            ajax: {
                url: function() {
                    if (currentType === 'Magang') {
                        return '{{ route("magangpustekinfo.admin.universitas.search") }}';
                    } else if (currentType === 'PKL') {
                        return '{{ route("magangpustekinfo.admin.sekolah.search") }}';
                    }
                    return '';
                },
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.results,
                        pagination: data.pagination
                    };
                },
                cache: true
            }
        });
        
        // Initialize Select2 for Jurusan
        $('#jurusan').select2({
            theme: 'bootstrap-5',
            placeholder: 'Ketik untuk mencari atau menambahkan jurusan...',
            allowClear: true,
            tags: true, // Allow custom input
            minimumInputLength: 0,
            ajax: {
                url: '{{ route("magangpustekinfo.public.jurusan.search") }}',
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term,
                        type: currentType, // 'Magang' or 'PKL'
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.results,
                        pagination: data.pagination
                    };
                },
                cache: true
            },
            createTag: function(params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                // Auto-capitalize first letter of each word for display
                var capitalizedTerm = term.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
                
                return {
                    id: capitalizedTerm,
                    text: capitalizedTerm + ' (Baru)',
                    newOption: true
                };
            }
        });

        // Update labels based on current type (Existing code function)
        function updateLabels() {
            if (currentType === 'Magang') {
                $('#label_institusi').text('Nama Universitas');
                $('#hint_institusi').text('Ketik minimal 2 huruf untuk mencari universitas');
            } else if (currentType === 'PKL') {
                $('#label_institusi').text('Nama Sekolah');
                $('#hint_institusi').text('Ketik minimal 2 huruf untuk mencari sekolah (SMA/SMK)');
            } else {
                $('#label_institusi').text('Nama Sekolah/Kampus');
                $('#hint_institusi').text('Pilih jenis program terlebih dahulu');
            }
        }
        
        // Handle tingkat_pendidikan change
        $('#tingkat_pendidikan').on('change', function() {
            currentType = $(this).val();
            
            // Clear current selection
            $('#nama_sekolah').val(null).trigger('change');
            
            updateLabels();
            
            if (currentType) {
                $('#nama_sekolah').prop('disabled', false);
            } else {
                $('#nama_sekolah').prop('disabled', true);
            }
        });
        
        // Initial label update
        updateLabels();
    });
</script>
@endpush


