<?php

use Modules\MagangPustekinfo\App\Http\Controllers\DashboardController;
use Modules\MagangPustekinfo\App\Http\Controllers\PesertaMagangController;
use Modules\MagangPustekinfo\App\Http\Controllers\UniversitasController;
use Modules\MagangPustekinfo\App\Http\Controllers\SekolahController;
use Modules\MagangPustekinfo\App\Http\Controllers\UniversitasCustomController;
use Modules\MagangPustekinfo\App\Http\Controllers\SekolahCustomController;
use Modules\MagangPustekinfo\App\Http\Controllers\JurusanController;
use Modules\MagangPustekinfo\App\Http\Controllers\KategoriProjectController;
use Modules\MagangPustekinfo\App\Http\Controllers\PendaftaranMagangController;
use Modules\MagangPustekinfo\App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'magang-pustekinfo'], function () {
    
    // Public routes untuk pendaftaran magang (tanpa auth)
    Route::get('/', [PendaftaranMagangController::class, 'index'])->name('magangpustekinfo.daftar_magang.index');
    Route::post('/', [PendaftaranMagangController::class, 'store'])->name('magangpustekinfo.daftar_magang.store');
    Route::get('/sukses', [PendaftaranMagangController::class, 'success'])->name('magangpustekinfo.daftar_magang.success');

    // Routes untuk pencarian sekolah/universitas/jurusan publik
    Route::get('/api/universitas/search', [UniversitasController::class, 'search'])->name('magangpustekinfo.public.universitas.search');
    Route::get('/api/sekolah/search', [SekolahController::class, 'search'])->name('magangpustekinfo.public.sekolah.search');
    Route::get('/api/jurusan/search', [JurusanController::class, 'search'])->name('magangpustekinfo.public.jurusan.search');
    Route::post('/api/universitas/custom', [UniversitasController::class, 'storeCustom'])->name('magangpustekinfo.public.universitas.storeCustom');
    Route::post('/api/sekolah/custom', [SekolahController::class, 'storeCustom'])->name('magangpustekinfo.public.sekolah.storeCustom');
    Route::post('/api/jurusan/custom', [JurusanController::class, 'storeCustom'])->name('magangpustekinfo.public.jurusan.storeCustom');

    // Login routes (using main app authentication)
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('magangpustekinfo.logout');

    // Admin routes (dengan middleware portal auth)
    Route::prefix('admin')->name('magangpustekinfo.admin.')->middleware('portal.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Peserta Magang routes
        Route::get('/peserta-magang', [PesertaMagangController::class, 'index'])->name('peserta_magang.index');
        Route::get('/peserta-magang/create', [PesertaMagangController::class, 'create'])->name('peserta_magang.create');
        Route::get('/peserta-magang/export', [PesertaMagangController::class, 'exportExcel'])->name('peserta_magang.export');
        Route::post('/peserta-magang', [PesertaMagangController::class, 'store'])->name('peserta_magang.store');
        Route::get('/peserta-magang/edit/{id}', [PesertaMagangController::class, 'edit'])->name('peserta_magang.edit');
        Route::put('/peserta-magang/{id}', [PesertaMagangController::class, 'update'])->name('peserta_magang.update');
        Route::delete('/peserta-magang/{id}', [PesertaMagangController::class, 'destroy'])->name('peserta_magang.destroy');

        // Universitas routes
        Route::get('/universitas', [UniversitasController::class, 'index'])->name('universitas.index');
        Route::get('/universitas/sync', [UniversitasController::class, 'sync'])->name('universitas.sync');
        Route::get('/universitas/search', [UniversitasController::class, 'search'])->name('universitas.search');

        // Sekolah routes
        Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
        Route::get('/sekolah/sync', [SekolahController::class, 'sync'])->name('sekolah.sync');
        Route::get('/sekolah/sync-province', [SekolahController::class, 'syncProvince'])->name('sekolah.syncProvince');
        Route::get('/sekolah/search', [SekolahController::class, 'search'])->name('sekolah.search');

        // Universitas Custom routes
        Route::get('/universitas-custom', [UniversitasCustomController::class, 'index'])->name('universitas_custom.index');
        Route::get('/universitas-custom/create', [UniversitasCustomController::class, 'create'])->name('universitas_custom.create');
        Route::post('/universitas-custom', [UniversitasCustomController::class, 'store'])->name('universitas_custom.store');
        Route::get('/universitas-custom/edit/{id}', [UniversitasCustomController::class, 'edit'])->name('universitas_custom.edit');
        Route::put('/universitas-custom/{id}', [UniversitasCustomController::class, 'update'])->name('universitas_custom.update');
        Route::delete('/universitas-custom/{id}', [UniversitasCustomController::class, 'destroy'])->name('universitas_custom.destroy');

        // Sekolah Custom routes
        Route::get('/sekolah-custom', [SekolahCustomController::class, 'index'])->name('sekolah_custom.index');
        Route::get('/sekolah-custom/create', [SekolahCustomController::class, 'create'])->name('sekolah_custom.create');
        Route::post('/sekolah-custom', [SekolahCustomController::class, 'store'])->name('sekolah_custom.store');
        Route::get('/sekolah-custom/edit/{id}', [SekolahCustomController::class, 'edit'])->name('sekolah_custom.edit');
        Route::put('/sekolah-custom/{id}', [SekolahCustomController::class, 'update'])->name('sekolah_custom.update');
        Route::delete('/sekolah-custom/{id}', [SekolahCustomController::class, 'destroy'])->name('sekolah_custom.destroy');

        // Jurusan routes
        Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
        Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::get('/jurusan/edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.edit');
        Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

        // Kategori Project routes
        Route::get('/kategori-project', [KategoriProjectController::class, 'index'])->name('kategori_project.index');
        Route::get('/kategori-project/create', [KategoriProjectController::class, 'create'])->name('kategori_project.create');
        Route::post('/kategori-project', [KategoriProjectController::class, 'store'])->name('kategori_project.store');
        Route::get('/kategori-project/edit/{id}', [KategoriProjectController::class, 'edit'])->name('kategori_project.edit');
        Route::put('/kategori-project/{id}', [KategoriProjectController::class, 'update'])->name('kategori_project.update');
        Route::delete('/kategori-project/{id}', [KategoriProjectController::class, 'destroy'])->name('kategori_project.destroy');
        Route::post('/kategori-project/{id}/toggle', [KategoriProjectController::class, 'toggleStatus'])->name('kategori_project.toggle');
    });

    // Redirect /admin ke dashboard jika login, atau ke login jika belum
    Route::get('/admin', function () {
        if (session()->has('portal_data') && session('portal_data')) {
            return redirect()->route('magangpustekinfo.admin.dashboard.index');
        }
        return redirect('/login');
    });
});
