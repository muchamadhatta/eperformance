@extends('magangpustekinfo::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Referensi</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Sekolah</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Sekolah</h4>
    </div>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#syncModal">
            <i class="ri-refresh-line"></i> Sinkronisasi
        </button>
    </div>
</div>

<!-- Sync Modal -->
<div class="modal fade" id="syncModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sinkronisasi Data Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalBtn"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="syncTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="single-tab" data-bs-toggle="tab" data-bs-target="#single" type="button">Satu Provinsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">Semua Provinsi</button>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <!-- Single Province Tab -->
                    <div class="tab-pane fade show active" id="single">
                        <form action="{{ route('magangpustekinfo.admin.sekolah.sync') }}" method="GET">
                            <div class="alert alert-info">
                                <i class="ri-information-line"></i> Pilih provinsi dan jenjang untuk sinkronisasi.
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Provinsi</label>
                                <select name="province" class="form-select" required>
                                    @foreach($provinces as $code => $name)
                                        <option value="{{ $code }}" {{ $code == '32' ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Jenjang</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="grades[]" value="SMA" id="gradeSMA" checked>
                                        <label class="form-check-label" for="gradeSMA">SMA</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="grades[]" value="SMK" id="gradeSMK" checked>
                                        <label class="form-check-label" for="gradeSMK">SMK</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="grades[]" value="SMP" id="gradeSMP">
                                        <label class="form-check-label" for="gradeSMP">SMP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="grades[]" value="SD" id="gradeSD">
                                        <label class="form-check-label" for="gradeSD">SD</label>
                                    </div>
                                </div>
                                <small class="text-muted">Default: SMA & SMK saja</small>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-refresh-line"></i> Mulai Sinkronisasi
                            </button>
                        </form>
                    </div>
                    
                    <!-- All Provinces Tab -->
                    <div class="tab-pane fade" id="all">
                        <div class="alert alert-warning">
                            <i class="ri-alert-line"></i> <strong>Peringatan:</strong> Proses ini akan mengambil data dari semua provinsi. 
                            Estimasi waktu: <strong>~15-30 menit</strong> (hanya SMA/SMK). Jangan tutup browser selama proses berlangsung.
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Pilih Jenjang</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input grade-all-check" type="checkbox" value="SMA" id="gradeAllSMA" checked>
                                    <label class="form-check-label" for="gradeAllSMA">SMA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input grade-all-check" type="checkbox" value="SMK" id="gradeAllSMK" checked>
                                    <label class="form-check-label" for="gradeAllSMK">SMK</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input grade-all-check" type="checkbox" value="SMP" id="gradeAllSMP">
                                    <label class="form-check-label" for="gradeAllSMP">SMP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input grade-all-check" type="checkbox" value="SD" id="gradeAllSD">
                                    <label class="form-check-label" for="gradeAllSD">SD</label>
                                </div>
                            </div>
                        </div>
                        
                        <div id="syncAllContainer">
                            <button type="button" class="btn btn-success btn-lg w-100" id="startSyncAll">
                                <i class="ri-refresh-line"></i> Sync Semua Provinsi ({{ count($provinces) }} provinsi)
                            </button>
                        </div>
                        
                        <!-- Progress Section (hidden initially) -->
                        <div id="syncProgress" style="display: none;">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span id="progressLabel">Memulai sinkronisasi...</span>
                                    <span id="progressPercent">0%</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" style="width: 0%"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Total disinkronkan: <span id="totalSynced">0</span> sekolah</strong>
                            </div>
                            
                            <div id="syncLog" style="max-height: 200px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 5px; font-size: 12px;">
                            </div>
                            
                            <button type="button" class="btn btn-danger mt-3" id="stopSync" style="display: none;">
                                <i class="ri-stop-line"></i> Stop Sinkronisasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Total Sekolah</h6>
                        <h3 class="mb-0" id="totalSchools">{{ number_format($totalCount) }}</h3>
                    </div>
                    <i class="ri-school-line" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Terakhir Sinkronisasi</h6>
                        <h5 class="mb-0">
                            @if($lastSync)
                                {{ $lastSync->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                            @else
                                <span class="text-warning">Belum pernah</span>
                            @endif
                        </h5>
                    </div>
                    <i class="ri-time-line" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Search Form -->
        <form method="GET" action="{{ route('magangpustekinfo.admin.sekolah.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               value="{{ $search ?? '' }}" placeholder="Cari nama/NPSN...">
                        <button class="btn btn-primary" type="submit">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="province" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $code => $name)
                            <option value="{{ $code }}" {{ $provinceCode == $code ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="grade" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenjang</option>
                        @foreach($grades as $g)
                            <option value="{{ $g }}" {{ $grade == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per halaman</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per halaman</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per halaman</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per halaman</option>
                    </select>
                </div>
                @if($search || $grade || $provinceCode)
                <div class="col-md-2">
                    <a href="{{ route('magangpustekinfo.admin.sekolah.index') }}" class="btn btn-secondary w-100">
                        <i class="ri-close-line"></i> Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        @if($totalCount == 0)
            <div class="alert alert-warning text-center">
                <i class="ri-information-line" style="font-size: 2rem;"></i>
                <p class="mt-2 mb-0">Belum ada data sekolah. Klik tombol <strong>"Sinkronisasi"</strong> untuk mengambil data dari API.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">NPSN</th>
                            <th scope="col" class="p-1 text-center">Nama Sekolah</th>
                            <th scope="col" class="p-1 text-center" style="width: 6%;">Jenjang</th>
                            <th scope="col" class="p-1 text-center" style="width: 6%;">Status</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Kabupaten/Kota</th>
                            <th scope="col" class="p-1 text-center" style="width: 8%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sekolah as $index => $item)
                            <tr>
                                <td class="text-center">{{ $sekolah->firstItem() + $index }}</td>
                                <td class="text-center">{{ $item->npsn ?? '-' }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    @if($item->grade)
                                        @php
                                            $gradeColors = [
                                                'SD' => 'success',
                                                'SMP' => 'info',
                                                'SMA' => 'primary',
                                                'SMK' => 'warning',
                                            ];
                                            $color = $gradeColors[$item->grade] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $color }}">{{ $item->grade }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'N')
                                        <span class="badge bg-success">Negeri</span>
                                    @elseif($item->status == 'S')
                                        <span class="badge bg-warning">Swasta</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->status ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->regency_name ?? '-' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data yang sesuai dengan pencarian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $sekolah->firstItem() ?? 0 }} - {{ $sekolah->lastItem() ?? 0 }} dari {{ $sekolah->total() }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $sekolah->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $sekolah->previousPageUrl() }}&search={{ $search }}&province={{ $provinceCode }}&grade={{ $grade }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">{{ $sekolah->currentPage() }} / {{ $sekolah->lastPage() }}</span>
                        </li>
                        <li class="page-item {{ !$sekolah->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $sekolah->nextPageUrl() }}&search={{ $search }}&province={{ $provinceCode }}&grade={{ $grade }}&per_page={{ $perPage }}">
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- Modals (outside of table) -->
@if(isset($sekolah) && count($sekolah) > 0)
    @foreach ($sekolah as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="ri-school-line me-2"></i>Detail Sekolah
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-info border-bottom pb-2 mb-3">
                                    <i class="ri-information-line me-1"></i>Informasi Umum
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="40%" class="text-muted">NPSN</th>
                                        <td><strong>{{ $item->npsn ?? '-' }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nama</th>
                                        <td><strong>{{ $item->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jenjang</th>
                                        <td>
                                            @if($item->grade)
                                                @php
                                                    $gradeColors = [
                                                        'SD' => 'success',
                                                        'SMP' => 'info',
                                                        'SMA' => 'primary',
                                                        'SMK' => 'warning',
                                                    ];
                                                    $color = $gradeColors[$item->grade] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $color }}">{{ $item->grade }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Status</th>
                                        <td>
                                            @if($item->status == 'N')
                                                <span class="badge bg-success">Negeri</span>
                                            @elseif($item->status == 'S')
                                                <span class="badge bg-warning">Swasta</span>
                                            @else
                                                {{ $item->status ?? '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-info border-bottom pb-2 mb-3">
                                    <i class="ri-map-pin-line me-1"></i>Lokasi
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="40%" class="text-muted">Alamat</th>
                                        <td>{{ $item->address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kecamatan</th>
                                        <td>{{ $item->district_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Kabupaten/Kota</th>
                                        <td>{{ $item->regency_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Provinsi</th>
                                        <td>{{ $item->province_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Koordinat</th>
                                        <td>
                                            @if($item->lang && $item->long)
                                                <a href="https://www.google.com/maps?q={{ $item->lang }},{{ $item->long }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="ri-map-pin-line"></i> Lihat Peta
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinces = @json($provinces);
    const provinceKeys = Object.keys(provinces);
    let currentIndex = 0;
    let totalSynced = 0;
    let isRunning = false;
    
    const startBtn = document.getElementById('startSyncAll');
    const stopBtn = document.getElementById('stopSync');
    const progressSection = document.getElementById('syncProgress');
    const syncContainer = document.getElementById('syncAllContainer');
    const progressBar = document.getElementById('progressBar');
    const progressLabel = document.getElementById('progressLabel');
    const progressPercent = document.getElementById('progressPercent');
    const totalSyncedSpan = document.getElementById('totalSynced');
    const syncLog = document.getElementById('syncLog');
    const closeModalBtn = document.getElementById('closeModalBtn');
    
    function logMessage(message, type = 'info') {
        const colors = {
            'success': 'text-success',
            'error': 'text-danger',
            'info': 'text-primary'
        };
        const time = new Date().toLocaleTimeString();
        syncLog.innerHTML += `<div class="${colors[type]}">[${time}] ${message}</div>`;
        syncLog.scrollTop = syncLog.scrollHeight;
    }
    
    function updateProgress() {
        const percent = Math.round((currentIndex / provinceKeys.length) * 100);
        progressBar.style.width = percent + '%';
        progressPercent.textContent = percent + '%';
    }
    
    async function syncNextProvince() {
        if (!isRunning || currentIndex >= provinceKeys.length) {
            isRunning = false;
            stopBtn.style.display = 'none';
            closeModalBtn.disabled = false;
            progressLabel.textContent = 'Sinkronisasi selesai!';
            progressBar.classList.remove('progress-bar-animated');
            progressBar.classList.add('bg-success');
            logMessage(`Selesai! Total ${totalSynced} sekolah disinkronkan dari ${currentIndex} provinsi.`, 'success');
            return;
        }
        
        const provinceCode = provinceKeys[currentIndex];
        const provinceName = provinces[provinceCode];
        
        progressLabel.textContent = `Sinkronisasi ${provinceName}... (${currentIndex + 1}/${provinceKeys.length})`;
        logMessage(`Memulai sinkronisasi ${provinceName}...`, 'info');
        
        try {
            const grades = window.syncGrades || 'SMA,SMK';
            const response = await fetch(`{{ route('magangpustekinfo.admin.sekolah.syncProvince') }}?province=${provinceCode}&grades=${grades}`);
            const data = await response.json();
            
            if (data.success) {
                totalSynced += data.synced;
                totalSyncedSpan.textContent = totalSynced.toLocaleString();
                logMessage(`✓ ${provinceName}: ${data.synced} sekolah`, 'success');
            } else {
                logMessage(`✗ ${provinceName}: ${data.message}`, 'error');
            }
        } catch (error) {
            logMessage(`✗ ${provinceName}: Error - ${error.message}`, 'error');
        }
        
        currentIndex++;
        updateProgress();
        
        setTimeout(syncNextProvince, 500);
    }
    
    startBtn.addEventListener('click', function() {
        // Get selected grades
        const selectedGrades = [];
        document.querySelectorAll('.grade-all-check:checked').forEach(function(el) {
            selectedGrades.push(el.value);
        });
        
        if (selectedGrades.length === 0) {
            alert('Pilih minimal satu jenjang!');
            return;
        }
        
        window.syncGrades = selectedGrades.join(',');
        
        currentIndex = 0;
        totalSynced = 0;
        isRunning = true;
        syncLog.innerHTML = '';
        
        syncContainer.style.display = 'none';
        document.querySelector('#all .mb-3').style.display = 'none'; // hide grade checkboxes
        progressSection.style.display = 'block';
        stopBtn.style.display = 'inline-block';
        closeModalBtn.disabled = true;
        
        progressBar.classList.remove('bg-success');
        progressBar.classList.add('progress-bar-animated');
        
        logMessage(`Memulai sinkronisasi semua provinsi (${selectedGrades.join(', ')})...`, 'info');
        syncNextProvince();
    });
    
    stopBtn.addEventListener('click', function() {
        isRunning = false;
        stopBtn.style.display = 'none';
        closeModalBtn.disabled = false;
        progressLabel.textContent = 'Sinkronisasi dihentikan';
        progressBar.classList.remove('progress-bar-animated');
        progressBar.classList.add('bg-warning');
        logMessage('Sinkronisasi dihentikan oleh pengguna.', 'error');
    });
    
    document.getElementById('syncModal').addEventListener('hidden.bs.modal', function() {
        if (!isRunning) {
            syncContainer.style.display = 'block';
            progressSection.style.display = 'none';
            location.reload();
        }
    });
});
</script>
@endsection


