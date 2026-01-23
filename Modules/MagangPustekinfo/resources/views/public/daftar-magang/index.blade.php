@extends('magangpustekinfo::layouts.public')

@section('title', 'Input Data Magang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7">
        <!-- Progress Stepper -->
        <div class="mb-4 animate-fade-in-up" style="display: flex; flex-direction: row; align-items: center; justify-content: center; padding: 1.5rem 2rem; background: rgba(255,255,255,0.95); border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <div class="stepper-item active" data-step="1" style="display: flex; flex-direction: column; align-items: center;">
                <div class="stepper-icon">
                    <i class="ri-user-line"></i>
                </div>
                <span class="stepper-label">Data Pribadi</span>
            </div>
            <div class="stepper-line" style="width: 60px; height: 3px; background: #e9ecef; margin: 0 1rem; border-radius: 2px; flex-shrink: 0;"></div>
            <div class="stepper-item" data-step="2" style="display: flex; flex-direction: column; align-items: center;">
                <div class="stepper-icon">
                    <i class="ri-book-open-line"></i>
                </div>
                <span class="stepper-label">Pendidikan</span>
            </div>
            <div class="stepper-line" style="width: 60px; height: 3px; background: #e9ecef; margin: 0 1rem; border-radius: 2px; flex-shrink: 0;"></div>
            <div class="stepper-item" data-step="3" style="display: flex; flex-direction: column; align-items: center;">
                <div class="stepper-icon">
                    <i class="ri-briefcase-line"></i>
                </div>
                <span class="stepper-label">Preferensi</span>
            </div>
        </div>

        <div class="card-glass animate-fade-in-up">
            <div class="card-header-custom">
                <div class="header-decoration"></div>
                <h2><i class="ri-user-add-line me-2"></i>Form Input Data Peserta Magang</h2>
                <p>Lengkapi data untuk keperluan pendataan internal PUSTEKINFO</p>
            </div>
            <div class="card-body-custom">
                @if(session('error'))
                    <div class="alert alert-custom alert-danger-custom mb-4">
                        <i class="ri-error-warning-line me-2"></i>{{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('magangpustekinfo.daftar_magang.store') }}" method="POST" id="formPendaftaran">
                    @csrf
                    
                    <!-- Step 1: Data Pribadi -->
                    <div class="form-step active" data-step="1">
                        <div class="form-section">
                            <h5 class="form-section-title">
                                <span class="section-number">01</span>
                                Jenis & Data Pribadi
                            </h5>
                            
                            <!-- Jenis Magang Selection -->
                            <div class="row g-4 mb-4">
                                <div class="col-12">
                                    <label class="form-label mb-3">Jenis Magang <span class="required">*</span></label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="category-card-new">
                                                <input class="form-check-input" type="radio" name="jenis_magang" 
                                                       id="jenis_hub" value="Hub" 
                                                       {{ old('jenis_magang') == 'Hub' ? 'checked' : '' }} required>
                                                <label class="category-label-new" for="jenis_hub">
                                                    <div class="category-icon">
                                                        <i class="ri-building-2-line"></i>
                                                    </div>
                                                    <span class="category-title">Magang Hub</span>
                                                    <span class="category-desc">Alumni/Profesional melalui kerjasama institusi</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="category-card-new">
                                                <input class="form-check-input" type="radio" name="jenis_magang" 
                                                       id="jenis_mandiri" value="Mandiri" 
                                                       {{ old('jenis_magang') == 'Mandiri' ? 'checked' : '' }} required>
                                                <label class="category-label-new" for="jenis_mandiri">
                                                    <div class="category-icon">
                                                        <i class="ri-user-star-line"></i>
                                                    </div>
                                                    <span class="category-title">Mandiri</span>
                                                    <span class="category-desc">Mahasiswa/Siswa yang masih menempuh pendidikan</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('jenis_magang')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Data Pribadi -->
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="text" 
                                               class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                               id="nama_lengkap" 
                                               name="nama_lengkap" 
                                               value="{{ old('nama_lengkap') }}" 
                                               placeholder=" "
                                               required>
                                        <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-user-line"></i></div>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder=" "
                                               required>
                                        <label for="email">Email <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-mail-line"></i></div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="text" 
                                               class="form-control @error('nomor_handphone') is-invalid @enderror" 
                                               id="nomor_handphone" 
                                               name="nomor_handphone" 
                                               value="{{ old('nomor_handphone') }}" 
                                               placeholder=" "
                                               required>
                                        <label for="nomor_handphone">Nomor WhatsApp <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-whatsapp-line"></i></div>
                                        @error('nomor_handphone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="text" 
                                               class="form-control @error('username_github') is-invalid @enderror" 
                                               id="username_github" 
                                               name="username_github" 
                                               value="{{ old('username_github') }}" 
                                               placeholder=" ">
                                        <label for="username_github">Username GitHub</label>
                                        <div class="input-icon"><i class="ri-github-fill"></i></div>
                                        @error('username_github')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-navigation">
                            <div></div>
                            <button type="button" class="btn btn-next" data-next="2">
                                Lanjutkan <i class="ri-arrow-right-line ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Data Pendidikan -->
                    <div class="form-step" data-step="2">
                        <div class="form-section">
                            <h5 class="form-section-title">
                                <span class="section-number">02</span>
                                Data Pendidikan
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <select class="form-select @error('tingkat_pendidikan') is-invalid @enderror" 
                                                id="tingkat_pendidikan" 
                                                name="tingkat_pendidikan" 
                                                required>
                                            <option value="" disabled selected></option>
                                            <option value="Magang" {{ old('tingkat_pendidikan') == 'Magang' ? 'selected' : '' }}>Magang (Mahasiswa)</option>
                                            <option value="PKL" {{ old('tingkat_pendidikan') == 'PKL' ? 'selected' : '' }}>PKL (Siswa SMA/SMK)</option>
                                        </select>
                                        <label for="tingkat_pendidikan">Jenis Program <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-bookmark-line"></i></div>
                                        @error('tingkat_pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div class="form-floating-custom autocomplete-wrapper flex-grow-1">
                                            <input type="text" 
                                                   class="form-control @error('nama_sekolah') is-invalid @enderror" 
                                                   id="nama_sekolah" 
                                                   name="nama_sekolah" 
                                                   value="{{ old('nama_sekolah') }}" 
                                                   placeholder=" "
                                                   autocomplete="off"
                                                   required>
                                            <label for="nama_sekolah" id="label_institusi">Nama Sekolah/Kampus <span class="required">*</span></label>
                                            <div class="input-icon"><i class="ri-building-line"></i></div>
                                            <div class="autocomplete-results" id="autocomplete_results"></div>
                                            @error('nama_sekolah')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-add-institusi" id="btnAddInstitusi" title="Tambah Institusi Baru">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom autocomplete-wrapper">
                                        <input type="text" 
                                               class="form-control @error('jurusan') is-invalid @enderror" 
                                               id="jurusan" 
                                               name="jurusan" 
                                               value="{{ old('jurusan') }}" 
                                               placeholder=" "
                                               autocomplete="off"
                                               required>
                                        <label for="jurusan">Jurusan/Program Studi <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-book-open-line"></i></div>
                                        <div class="autocomplete-results" id="autocomplete_jurusan"></div>
                                        @error('jurusan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="number" 
                                               class="form-control @error('semester') is-invalid @enderror" 
                                               id="semester" 
                                               name="semester" 
                                               value="{{ old('semester') }}" 
                                               min="1" 
                                               max="14"
                                               placeholder=" ">
                                        <label for="semester" id="label_semester">Semester/Kelas</label>
                                        <div class="input-icon"><i class="ri-numbers-line"></i></div>
                                        @error('semester')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-navigation">
                            <button type="button" class="btn btn-back" data-prev="1">
                                <i class="ri-arrow-left-line me-2"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-next" data-next="3">
                                Lanjutkan <i class="ri-arrow-right-line ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Preferensi Magang -->
                    <div class="form-step" data-step="3">
                        <div class="form-section">
                            <h5 class="form-section-title">
                                <span class="section-number">03</span>
                                Preferensi Magang
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label mb-3">Kategori Project <span class="required">*</span></label>
                                    <div class="category-grid">
                                        @foreach($kategori_project as $kategori)
                                        <div class="category-card-new">
                                            <input class="form-check-input" type="radio" name="kategori_project" 
                                                   id="kategori_{{ $kategori->id }}" value="{{ $kategori->name }}" 
                                                   {{ old('kategori_project') == $kategori->name ? 'checked' : '' }} required>
                                            <label class="category-label-new" for="kategori_{{ $kategori->id }}">
                                                <div class="category-icon">
                                                    <i class="{{ $kategori->icon ?? 'ri-folder-line' }}"></i>
                                                </div>
                                                <span class="category-title">{{ $kategori->name }}</span>
                                                <span class="category-desc">{{ $kategori->description }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('kategori_project')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="date" 
                                               class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                               id="tanggal_mulai" 
                                               name="tanggal_mulai" 
                                               value="{{ old('tanggal_mulai') }}"
                                               placeholder=" "
                                               required>
                                        <label for="tanggal_mulai">Tanggal Mulai <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-calendar-line"></i></div>
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating-custom">
                                        <input type="date" 
                                               class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                               id="tanggal_selesai" 
                                               name="tanggal_selesai" 
                                               value="{{ old('tanggal_selesai') }}"
                                               placeholder=" "
                                               required>
                                        <label for="tanggal_selesai">Tanggal Selesai <span class="required">*</span></label>
                                        <div class="input-icon"><i class="ri-calendar-check-line"></i></div>
                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating-custom textarea-wrapper">
                                        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                                  id="catatan" 
                                                  name="catatan" 
                                                  rows="3" 
                                                  placeholder=" ">{{ old('catatan') }}</textarea>
                                        <label for="catatan">Catatan Tambahan</label>
                                        @error('catatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-navigation">
                            <button type="button" class="btn btn-back" data-prev="2">
                                <i class="ri-arrow-left-line me-2"></i> Kembali
                            </button>
                            <button type="submit" class="btn btn-submit">
                                <i class="ri-check-double-line me-2"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Universitas/Sekolah Baru -->
<div class="modal fade" id="addInstitusiModal" tabindex="-1" aria-labelledby="addInstitusiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="addInstitusiModalLabel">
                    <i class="ri-add-circle-line me-2"></i>Tambah Institusi Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4" id="modal_description">Institusi tidak ditemukan? Tambahkan data baru di sini.</p>
                
                <div class="row g-3">
                    <!-- Nama (Shared) -->
                    <div class="col-md-8">
                        <div class="form-floating-custom">
                            <input type="text" class="form-control" id="custom_institusi_name" placeholder=" " required>
                            <label for="custom_institusi_name" id="label_nama">Nama <span class="required">*</span></label>
                            <div class="input-icon"><i class="ri-building-line"></i></div>
                        </div>
                    </div>
                    
                    <!-- Singkatan/NPSN -->
                    <div class="col-md-4">
                        <div class="form-floating-custom">
                            <input type="text" class="form-control" id="custom_institusi_short_name" placeholder=" ">
                            <label for="custom_institusi_short_name" id="label_singkatan">Singkatan</label>
                            <div class="input-icon"><i class="ri-text" id="icon_singkatan"></i></div>
                        </div>
                    </div>
                    
                    <!-- Universitas Fields -->
                    <div class="col-md-6 universitas-fields">
                        <div class="form-floating-custom">
                            <select class="form-select" id="custom_institusi_group">
                                <option value="" selected>Pilih grup</option>
                                <option value="PTN">PTN (Perguruan Tinggi Negeri)</option>
                                <option value="PTS">PTS (Perguruan Tinggi Swasta)</option>
                            </select>
                            <label for="custom_institusi_group">Grup</label>
                            <div class="input-icon"><i class="ri-government-line"></i></div>
                        </div>
                    </div>
                    <div class="col-md-6 universitas-fields">
                        <div class="form-floating-custom">
                            <select class="form-select" id="custom_institusi_type">
                                <option value="" selected>Pilih tipe</option>
                                <option value="Universitas">Universitas</option>
                                <option value="Institut">Institut</option>
                                <option value="Politeknik">Politeknik</option>
                                <option value="Sekolah Tinggi">Sekolah Tinggi</option>
                                <option value="Akademi">Akademi</option>
                            </select>
                            <label for="custom_institusi_type">Tipe Perguruan Tinggi</label>
                            <div class="input-icon"><i class="ri-building-2-line"></i></div>
                        </div>
                    </div>
                    
                    <!-- Sekolah Fields -->
                    <div class="col-md-6 sekolah-fields" style="display: none;">
                        <div class="form-floating-custom">
                            <select class="form-select" id="custom_sekolah_grade">
                                <option value="" selected>Pilih jenjang</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                            </select>
                            <label for="custom_sekolah_grade">Jenjang</label>
                            <div class="input-icon"><i class="ri-graduation-cap-line"></i></div>
                        </div>
                    </div>
                    <div class="col-md-6 sekolah-fields" style="display: none;">
                        <div class="form-floating-custom">
                            <select class="form-select" id="custom_sekolah_status">
                                <option value="" selected>Pilih status</option>
                                <option value="N">Negeri</option>
                                <option value="S">Swasta</option>
                            </select>
                            <label for="custom_sekolah_status">Status</label>
                            <div class="input-icon"><i class="ri-shield-check-line"></i></div>
                        </div>
                    </div>
                    
                    <!-- Alamat (Shared) -->
                    <div class="col-12">
                        <div class="form-floating-custom">
                            <input type="text" class="form-control" id="custom_institusi_address" placeholder=" ">
                            <label for="custom_institusi_address">Alamat</label>
                            <div class="input-icon"><i class="ri-map-pin-line"></i></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <input type="text" class="form-control" id="custom_institusi_province" placeholder=" ">
                            <label for="custom_institusi_province">Provinsi</label>
                            <div class="input-icon"><i class="ri-map-2-line"></i></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <input type="text" class="form-control" id="custom_institusi_regency" placeholder=" ">
                            <label for="custom_institusi_regency">Kabupaten/Kota</label>
                            <div class="input-icon"><i class="ri-community-line"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-back" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-submit" id="btnSaveCustomInstitusi">
                    <i class="ri-save-line me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Progress Stepper */
    .progress-stepper {
        display: inline-flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        align-items: flex-start;
        justify-content: center;
        gap: 0;
        padding: 1.5rem 2rem;
        background: rgba(255,255,255,0.95);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        width: 100%;
    }
    
    .stepper-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }
    
    .stepper-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9ecef;
        color: #adb5bd;
        font-size: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 3px solid transparent;
    }
    
    .stepper-item.active .stepper-icon {
        background: var(--gradient-primary);
        color: white;
        border-color: rgba(107, 28, 42, 0.2);
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(107, 28, 42, 0.3);
    }
    
    .stepper-item.completed .stepper-icon {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .stepper-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #adb5bd;
        transition: all 0.3s ease;
    }
    
    .stepper-item.active .stepper-label,
    .stepper-item.completed .stepper-label {
        color: var(--color-primary);
    }
    
    .stepper-line {
        width: 60px;
        height: 3px;
        background: #e9ecef;
        margin: 0 0.5rem;
        align-self: center;
        margin-top: -1.5rem;
        border-radius: 2px;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .stepper-line::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0;
        background: var(--gradient-primary);
        transition: width 0.4s ease;
    }
    
    .stepper-line.active::after {
        width: 100%;
    }
    
    /* Form Floating Custom */
    .form-floating-custom {
        position: relative;
    }
    
    .form-floating-custom .form-control,
    .form-floating-custom .form-select {
        height: 60px;
        padding: 1.5rem 1rem 0.5rem 3rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 0.95rem;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }
    
    .form-floating-custom textarea.form-control {
        height: auto;
        min-height: 100px;
        padding-top: 2rem;
    }
    
    .form-floating-custom .form-control:focus,
    .form-floating-custom .form-select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 4px rgba(107, 28, 42, 0.08);
        background-color: #fff;
    }
    
    .form-floating-custom label {
        position: absolute;
        left: 3rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.95rem;
        color: #888;
        pointer-events: none;
        transition: all 0.2s ease;
        background: transparent;
        padding: 0 0.25rem;
    }
    
    .textarea-wrapper label {
        top: 1.5rem;
        transform: none;
    }
    
    .form-floating-custom .form-control:focus ~ label,
    .form-floating-custom .form-control:not(:placeholder-shown) ~ label,
    .form-floating-custom .form-select:focus ~ label,
    .form-floating-custom .form-select:valid ~ label {
        top: 0.5rem;
        transform: none;
        font-size: 0.75rem;
        color: var(--color-primary);
        font-weight: 600;
    }
    
    .form-floating-custom .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }
    
    .textarea-wrapper .input-icon {
        display: none;
    }
    
    .form-floating-custom .form-control:focus ~ .input-icon {
        color: var(--color-primary);
    }
    
    .required {
        color: #ef4444;
    }
    
    /* Section Title */
    .form-section-title {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--color-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .section-number {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gradient-primary);
        color: white;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    
    /* Category Grid */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 992px) {
        .category-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .category-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    .category-card-new {
        position: relative;
    }
    
    .category-card-new .form-check-input {
        position: absolute;
        opacity: 0;
    }
    
    .category-label-new {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem 1rem;
        background: #fafafa;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        min-height: 130px;
    }
    
    .category-label-new:hover {
        border-color: var(--color-primary-light);
        background: #fff;
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(107, 28, 42, 0.1);
    }
    
    .category-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(107, 28, 42, 0.08);
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .category-icon i {
        font-size: 1.5rem;
        color: var(--color-primary);
    }
    
    .category-title {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .category-desc {
        font-size: 0.7rem;
        color: #888;
    }
    
    .category-card-new .form-check-input:checked + .category-label-new {
        border-color: var(--color-primary);
        background: linear-gradient(135deg, rgba(107, 28, 42, 0.03) 0%, rgba(212, 175, 55, 0.05) 100%);
        box-shadow: 0 8px 30px rgba(107, 28, 42, 0.15);
    }
    
    .category-card-new .form-check-input:checked + .category-label-new .category-icon {
        background: var(--gradient-primary);
    }
    
    .category-card-new .form-check-input:checked + .category-label-new .category-icon i {
        color: white;
    }
    
    /* Form Navigation */
    .form-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f0f0f0;
    }
    
    .btn-next, .btn-submit {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(107, 28, 42, 0.25);
    }
    
    .btn-next:hover, .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 28, 42, 0.35);
        color: white;
    }
    
    .btn-back {
        background: transparent;
        color: #666;
        border: 2px solid #e9ecef;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #f8f9fa;
        border-color: #dee2e6;
        color: #333;
    }
    
    /* Form Steps */
    .form-step {
        display: none;
        animation: fadeSlideIn 0.4s ease;
    }
    
    .form-step.active {
        display: block;
    }
    
    @keyframes fadeSlideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Autocomplete */
    .autocomplete-wrapper {
        position: relative;
    }
    
    .autocomplete-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #e9ecef;
        border-top: none;
        border-radius: 0 0 12px 12px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .autocomplete-results.show {
        display: block;
    }
    
    .autocomplete-item {
        padding: 0.75rem 1rem 0.75rem 3rem;
        cursor: pointer;
        transition: background 0.2s ease;
        font-size: 0.9rem;
    }
    
    .autocomplete-item:hover {
        background: rgba(107, 28, 42, 0.05);
    }
    
    .autocomplete-loading, .autocomplete-empty {
        padding: 1rem;
        text-align: center;
        color: #888;
        font-size: 0.85rem;
    }
    
    .autocomplete-add-new,
    .autocomplete-add-jurusan {
        padding: 0.75rem 1rem 0.75rem 3rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        background: linear-gradient(135deg, rgba(107, 28, 42, 0.05) 0%, rgba(212, 175, 55, 0.05) 100%);
        border-top: 1px solid #e9ecef;
        color: var(--color-primary);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .autocomplete-add-new:hover,
    .autocomplete-add-jurusan:hover {
        background: linear-gradient(135deg, rgba(107, 28, 42, 0.1) 0%, rgba(212, 175, 55, 0.1) 100%);
    }
    
    .autocomplete-add-new i {
        font-size: 1.1rem;
    }
    
    /* Modal Custom */
    .modal-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .modal-custom .modal-header {
        background: var(--gradient-primary);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 1.25rem 1.5rem;
        border: none;
    }
    
    .modal-custom .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .modal-custom .modal-body {
        padding: 1.5rem;
    }
    
    .modal-custom .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Button Add Institusi */
    .btn-add-institusi {
        width: 60px;
        height: 60px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(107, 28, 42, 0.25);
        flex-shrink: 0;
    }
    
    .btn-add-institusi:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 28, 42, 0.35);
        color: white;
    }
    
    .btn-add-institusi:active {
        transform: translateY(0);
    }
    
    /* Header Decoration */
    .card-header-custom {
        position: relative;
        overflow: hidden;
    }
    
    .header-decoration {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .progress-stepper {
            padding: 1rem;
        }
        
        .stepper-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .stepper-line {
            width: 30px;
        }
        
        .stepper-label {
            font-size: 0.65rem;
        }
        
        .form-navigation {
            flex-direction: column;
            gap: 1rem;
        }
        
        .form-navigation button {
            width: 100%;
        }
    }
    /* FIX: Allow autocomplete to overflow card */
    .card-glass {
        overflow: visible !important;
    }
    
    /* FIX: Restore rounded corners for header since overflow is visible */
    .card-header-custom {
        border-radius: 20px 20px 0 0;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        let currentStep = 1;
        let currentType = null;
        let searchTimeout = null;
        
        const $input = $('#nama_sekolah');
        const $results = $('#autocomplete_results');

        // Numeric validation listener
        $('#nomor_handphone, #semester').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        // Step Navigation
        function goToStep(step) {
            $('.form-step').removeClass('active');
            $(`.form-step[data-step="${step}"]`).addClass('active');
            
            // Update stepper
            $('.stepper-item').each(function() {
                const itemStep = $(this).data('step');
                $(this).removeClass('active completed');
                
                if (itemStep < step) {
                    $(this).addClass('completed');
                } else if (itemStep === step) {
                    $(this).addClass('active');
                }
            });
            
            // Update lines
            $('.stepper-line').each(function(index) {
                if (index < step - 1) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
            
            currentStep = step;
            
            // Scroll to top of form
            $('html, body').animate({
                scrollTop: $('.card-glass').offset().top - 100
            }, 300);
        }
        
        // Next button
        $(document).on('click', '.btn-next', function() {
            let nextStep = $(this).data('next');
            
            // Simple validation for current step
            let valid = true;
            $(`.form-step[data-step="${currentStep}"] [required]`).each(function() {
                // Skip validation for radio buttons that are part of a group
                if ($(this).attr('type') === 'radio') {
                    const name = $(this).attr('name');
                    if (!$(`input[name="${name}"]:checked`).length) {
                        $(this).closest('.col-12, .col-md-6').find('.category-card-new').addClass('border-danger');
                        valid = false;
                    } else {
                        $(this).closest('.col-12, .col-md-6').find('.category-card-new').removeClass('border-danger');
                    }
                } else if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (valid) {
                // Skip Step 2 if Hub is selected
                const jenisMagang = $('input[name="jenis_magang"]:checked').val();
                if (currentStep === 1 && jenisMagang === 'Hub') {
                    nextStep = 3;
                    // Remove required from Step 2 fields
                    $('#tingkat_pendidikan, #nama_sekolah, #jurusan').removeAttr('required');
                } else if (currentStep === 1 && jenisMagang === 'Mandiri') {
                    // Add required back to Step 2 fields
                    $('#tingkat_pendidikan, #nama_sekolah, #jurusan').attr('required', 'required');
                }
                goToStep(nextStep);
            }
        });
        
        // Back button
        $(document).on('click', '.btn-back', function() {
            let prevStep = $(this).data('prev');
            
            // Skip Step 2 if Hub is selected when going back
            const jenisMagang = $('input[name="jenis_magang"]:checked').val();
            if (currentStep === 3 && jenisMagang === 'Hub') {
                prevStep = 1;
            }
            goToStep(prevStep);
        });
        
        // Handle tingkat_pendidikan change
        $('#tingkat_pendidikan').on('change', function() {
            currentType = $(this).val();
            
            if (currentType === 'Magang') {
                $('#label_institusi').html('Nama Universitas <span class="required">*</span>');
                $('#label_semester').text('Semester');
                $input.attr('placeholder', ' ');
            } else if (currentType === 'PKL') {
                $('#label_institusi').html('Nama Sekolah <span class="required">*</span>');
                $('#label_semester').text('Kelas');
                $input.attr('placeholder', ' ');
            }
            
            $input.val('');
            $results.removeClass('show').empty();
        });
        
        // Button Add Institusi click handler
        $('#btnAddInstitusi').on('click', function() {
            const isUniversitas = currentType === 'Magang';
            
            // Reset all fields
            $('#custom_institusi_name').val('');
            $('#custom_institusi_short_name').val('');
            $('#custom_institusi_group').val('');
            $('#custom_institusi_type').val('');
            $('#custom_institusi_address').val('');
            $('#custom_institusi_province').val('');
            $('#custom_institusi_regency').val('');
            $('#custom_sekolah_grade').val('');
            $('#custom_sekolah_status').val('');
            
            if (isUniversitas) {
                // Show universitas fields, hide sekolah fields
                $('.universitas-fields').show();
                $('.sekolah-fields').hide();
                
                // Update labels
                $('#addInstitusiModalLabel').html('<i class="ri-add-circle-line me-2"></i>Tambah Universitas Baru');
                $('#modal_description').text('Universitas tidak ditemukan? Tambahkan data baru di sini.');
                $('#label_nama').html('Nama Universitas <span class="required">*</span>');
                $('#label_singkatan').text('Singkatan');
                $('#icon_singkatan').removeClass('ri-barcode-line').addClass('ri-text');
            } else {
                // Show sekolah fields, hide universitas fields
                $('.universitas-fields').hide();
                $('.sekolah-fields').show();
                
                // Update labels
                $('#addInstitusiModalLabel').html('<i class="ri-add-circle-line me-2"></i>Tambah Sekolah Baru');
                $('#modal_description').text('Sekolah tidak ditemukan? Tambahkan data baru di sini.');
                $('#label_nama').html('Nama Sekolah <span class="required">*</span>');
                $('#label_singkatan').text('NPSN');
                $('#icon_singkatan').removeClass('ri-text').addClass('ri-barcode-line');
            }
            
            var modal = new bootstrap.Modal(document.getElementById('addInstitusiModal'));
            modal.show();
        });
        
        // Handle input typing for autocomplete
        $input.on('input', function() {
            const query = $(this).val().trim();
            
            if (searchTimeout) clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                $results.removeClass('show').empty();
                return;
            }
            
            $results.addClass('show').html('<div class="autocomplete-loading"><i class="ri-loader-4-line"></i> Mencari...</div>');
            
            searchTimeout = setTimeout(function() {
                let url = currentType === 'Magang' 
                    ? '{{ route("magangpustekinfo.public.universitas.search") }}' 
                    : '{{ route("magangpustekinfo.public.sekolah.search") }}';
                
                if (!currentType) url = '{{ route("magangpustekinfo.public.universitas.search") }}';
                
                $.ajax({
                    url: url,
                    data: { q: query },
                    dataType: 'json',
                    success: function(data) {
                        let html = '';
                        if (data.results && data.results.length > 0) {
                            data.results.forEach(function(item) {
                                html += '<div class="autocomplete-item" data-value="' + item.text + '">' + item.text + '</div>';
                            });
                        } else {
                            html += '<div class="autocomplete-empty">Tidak ditemukan</div>';
                        }
                        // Selalu tampilkan opsi tambah baru
                        html += '<div class="autocomplete-add-new" data-query="' + query + '"><i class="ri-add-circle-line"></i> Tidak ada? Tambah "' + query + '"</div>';
                        $results.html(html);
                    },
                    error: function() {
                        $results.html('<div class="autocomplete-empty">Gagal mencari</div>');
                    }
                });
            }, 300);
        });
        
        // Click autocomplete item
        // Click autocomplete item (Institusi)
        $(document).on('click', '#autocomplete_results .autocomplete-item', function() {
            $input.val($(this).data('value'));
            $results.removeClass('show').empty();
        });
        
        // Hide autocomplete on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.autocomplete-wrapper').length) {
                $results.removeClass('show');
            }
        });
        
        // Click add new option
        $(document).on('click', '.autocomplete-add-new', function() {
            const query = $(this).data('query');
            const isUniversitas = currentType === 'Magang';
            
            // Reset all fields
            $('#custom_institusi_short_name').val('');
            $('#custom_institusi_group').val('');
            $('#custom_institusi_type').val('');
            $('#custom_institusi_address').val('');
            $('#custom_institusi_province').val('');
            $('#custom_institusi_regency').val('');
            $('#custom_sekolah_grade').val('');
            $('#custom_sekolah_status').val('');
            
            // Set name from query
            $('#custom_institusi_name').val(query);
            
            if (isUniversitas) {
                // Show universitas fields, hide sekolah fields
                $('.universitas-fields').show();
                $('.sekolah-fields').hide();
                
                // Update labels
                $('#addInstitusiModalLabel').html('<i class="ri-add-circle-line me-2"></i>Tambah Universitas Baru');
                $('#modal_description').text('Universitas tidak ditemukan? Tambahkan data baru di sini.');
                $('#label_nama').html('Nama Universitas <span class="required">*</span>');
                $('#label_singkatan').text('Singkatan');
                $('#icon_singkatan').removeClass('ri-barcode-line').addClass('ri-text');
            } else {
                // Show sekolah fields, hide universitas fields
                $('.universitas-fields').hide();
                $('.sekolah-fields').show();
                
                // Update labels
                $('#addInstitusiModalLabel').html('<i class="ri-add-circle-line me-2"></i>Tambah Sekolah Baru');
                $('#modal_description').text('Sekolah tidak ditemukan? Tambahkan data baru di sini.');
                $('#label_nama').html('Nama Sekolah <span class="required">*</span>');
                $('#label_singkatan').text('NPSN');
                $('#icon_singkatan').removeClass('ri-text').addClass('ri-barcode-line');
            }
            
            $results.removeClass('show');
            
            var modal = new bootstrap.Modal(document.getElementById('addInstitusiModal'));
            modal.show();
        });
        
        // Save custom institusi
        $('#btnSaveCustomInstitusi').on('click', function() {
            const name = $('#custom_institusi_name').val().trim();
            const short_name = $('#custom_institusi_short_name').val().trim();
            const address = $('#custom_institusi_address').val().trim();
            const province = $('#custom_institusi_province').val().trim();
            const regency = $('#custom_institusi_regency').val().trim();
            
            if (!name) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama institusi harus diisi!'
                });
                return;
            }
            
            const $btn = $(this);
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');
            
            // Determine URL and data based on type
            let url, data;
            if (currentType === 'Magang') {
                // Universitas
                const group = $('#custom_institusi_group').val();
                const university_type = $('#custom_institusi_type').val();
                
                url = '{{ route("magangpustekinfo.public.universitas.storeCustom") }}';
                data = {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    short_name: short_name,
                    group: group,
                    university_type: university_type,
                    address: address,
                    province: province,
                    regency: regency
                };
            } else {
                // PKL - Sekolah
                const grade = $('#custom_sekolah_grade').val();
                const status = $('#custom_sekolah_status').val();
                
                url = '{{ route("magangpustekinfo.public.sekolah.storeCustom") }}';
                data = {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    npsn: short_name,
                    grade: grade,
                    status: status,
                    address: address,
                    province_name: province,
                    regency_name: regency
                };
            }
            
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Set value ke input
                        $input.val(name);
                        
                        // Reset form modal
                        $('#custom_institusi_name').val('');
                        $('#custom_institusi_short_name').val('');
                        $('#custom_institusi_group').val('');
                        $('#custom_institusi_type').val('');
                        $('#custom_institusi_address').val('');
                        $('#custom_institusi_province').val('');
                        $('#custom_institusi_regency').val('');
                        
                        // Tutup modal
                        bootstrap.Modal.getInstance(document.getElementById('addInstitusiModal')).hide();
                        
                        // Reset button
                        $btn.prop('disabled', false).html('<i class="ri-save-line me-2"></i>Simpan');
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Institusi berhasil ditambahkan!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
                    });
                    $btn.prop('disabled', false).html('<i class="ri-save-line me-2"></i>Simpan');
                }
            });
        });
        
        // ========================================
        // JURUSAN AUTOCOMPLETE & MODAL HANDLERS
        // ========================================
        
        const $jurusanInput = $('#jurusan');
        const $jurusanResults = $('#autocomplete_jurusan');
        let jurusanSearchTimeout = null;
        
        // Jurusan autocomplete input handler
        $jurusanInput.on('input', function() {
            const query = $(this).val().trim();
            
            if (jurusanSearchTimeout) clearTimeout(jurusanSearchTimeout);
            
            if (query.length < 2) {
                $jurusanResults.removeClass('show').empty();
                return;
            }
            
            $jurusanResults.addClass('show').html('<div class="autocomplete-loading"><i class="ri-loader-4-line"></i> Mencari...</div>');
            
            jurusanSearchTimeout = setTimeout(function() {
                $.ajax({
                    url: '{{ route("magangpustekinfo.public.jurusan.search") }}',
                    method: 'GET',
                    data: { q: query, type: currentType },
                    dataType: 'json',
                    success: function(response) {
                        if (response.results && response.results.length > 0) {
                            let html = '';
                            response.results.forEach(function(item) {
                                html += '<div class="autocomplete-item" data-value="' + item.id + '">' + item.text + '</div>';
                            });
                            html += '<div class="autocomplete-add-jurusan" data-query="' + query + '"><i class="ri-add-line me-2"></i>Tambah "' + query + '"</div>';
                            $jurusanResults.html(html);
                        } else {
                            $jurusanResults.html('<div class="autocomplete-add-jurusan" data-query="' + query + '"><i class="ri-add-line me-2"></i>Tambah "' + query + '"</div>');
                        }
                    },
                    error: function() {
                        $jurusanResults.html('<div class="autocomplete-add-jurusan" data-query="' + query + '"><i class="ri-add-line me-2"></i>Tambah "' + query + '"</div>');
                    }
                });
            }, 300);
        });
        
        // Click jurusan result item
        $(document).on('click', '#autocomplete_jurusan .autocomplete-item', function() {
            const value = $(this).data('value');
            $jurusanInput.val(value);
            $jurusanResults.removeClass('show').empty();
        });
        
        // Hide jurusan autocomplete on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#jurusan').length && !$(e.target).closest('#autocomplete_jurusan').length) {
                $jurusanResults.removeClass('show');
            }
        });
        
        // Click add new jurusan from autocomplete - langsung save tanpa modal
        $(document).on('click', '.autocomplete-add-jurusan', function() {
            const query = $(this).data('query');
            const $addBtn = $(this);
            
            // Show loading state
            $addBtn.html('<i class="ri-loader-4-line me-2"></i>Menyimpan...');
            
            // Auto-set level based on tingkat pendidikan
            const level = currentType === 'Magang' ? 'S1' : 'SMK';
            
            console.log('Saving jurusan:', query, 'level:', level, 'currentType:', currentType);
            
            $.ajax({
                url: '{{ route("magangpustekinfo.public.jurusan.storeCustom") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: query,
                    level: level
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Jurusan save success:', response);
                    if (response.success) {
                        // Set value ke input jurusan
                        $jurusanInput.val(query);
                        $jurusanResults.removeClass('show').empty();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Jurusan berhasil ditambahkan!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Jurusan save error:', xhr.responseText, status, error);
                    // Tetap set value meskipun gagal save (UX decision) - maybe add warning
                     Swal.fire({
                        icon: 'warning',
                        title: 'Gagal Menyimpan',
                        text: 'Jurusan gagal disimpan ke database, tetapi tetap digunakan di form ini.',
                    });
                    
                    $jurusanInput.val(query);
                    $jurusanResults.removeClass('show').empty();
                }
            });
        });
        
        // Form submit loading
        $('#formPendaftaran').on('submit', function() {
            $(this).find('.btn-submit').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...'
            );
        });
    });
</script>
@endpush



