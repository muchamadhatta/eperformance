<?php

use Illuminate\Support\Facades\Route;
use Modules\MagangPustekinfo\App\Http\Controllers\UniversitasController;
use Modules\MagangPustekinfo\App\Http\Controllers\SekolahController;
use Modules\MagangPustekinfo\App\Http\Controllers\JurusanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('magang-pustekinfo')->group(function () {
    // Search endpoints
    Route::get('/universitas/search', [UniversitasController::class, 'search'])->name('api.magangpustekinfo.universitas.search');
    Route::get('/sekolah/search', [SekolahController::class, 'search'])->name('api.magangpustekinfo.sekolah.search');
    Route::get('/jurusan/search', [JurusanController::class, 'search'])->name('api.magangpustekinfo.jurusan.search');
    
    // Custom data endpoints
    Route::post('/universitas/custom', [UniversitasController::class, 'storeCustom'])->name('api.magangpustekinfo.universitas.storeCustom');
    Route::post('/sekolah/custom', [SekolahController::class, 'storeCustom'])->name('api.magangpustekinfo.sekolah.storeCustom');
    Route::post('/jurusan/custom', [JurusanController::class, 'storeCustom'])->name('api.magangpustekinfo.jurusan.storeCustom');
});
