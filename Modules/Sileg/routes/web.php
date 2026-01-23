<?php

use Modules\Sileg\App\Http\Controllers\SilegController;
use Modules\Sileg\App\Http\Controllers\StatistikController;
use Modules\Sileg\App\Http\Controllers\KomisiController;
use Modules\Sileg\App\Http\Controllers\FraksiController;
use Modules\Sileg\App\Http\Controllers\DpdController;
use Modules\Sileg\App\Http\Controllers\PemerintahController;
use Modules\Sileg\App\Http\Controllers\MasyarakatController;
use Modules\Sileg\App\Http\Controllers\KumulatifController;
use Modules\Sileg\App\Http\Controllers\Pembahasan_ruuController;
use Modules\Sileg\App\Http\Controllers\RuuController;
use Modules\Sileg\App\Http\Controllers\FeedbackController;
use Modules\Sileg\App\Http\Controllers\Ruu_riwayatController;
use Modules\Sileg\App\Http\Controllers\Ruu_longlistController;

use Illuminate\Support\Facades\Route;
use Modules\Sileg\App\Http\Controllers\Auth\LoginController;

// use Ramsey\Collection\Map\NamedParameterMap;


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

Route::group(['prefix' => 'sileg'], function () {

        Route::get('/', [SilegController::class, 'index'])->name('sileg.index');



        Route::resource('statistik', StatistikController::class);
        Route::resource('komisi', KomisiController::class);
        Route::resource('fraksi', FraksiController::class);



        Route::resource('dpd', DpdController::class);

        Route::resource('pemerintah', PemerintahController::class);

        Route::resource('masyarakat', MasyarakatController::class);

        Route::resource('pembahasan_ruu', Pembahasan_ruuController::class);


        Route::resource('kumulatif', KumulatifController::class);

        Route::resource('ruu', RuuController::class);

        //ruu_pengusul
        Route::post('ruu_pengusul', [RuuController::class, 'store_ruu_pengusul'])->name('ruu.store_ruu_pengusul');
        Route::put('ruu_pengusul/{id}', [RuuController::class, 'update_ruu_pengusul'])->name('ruu.update_ruu_pengusul');
        Route::delete('ruu_pengusul/{id}', [RuuController::class, 'destroy_ruu_pengusul'])->name('ruu.destroy_ruu_pengusul');

        //ruu_deskripsi_konsepsi
        Route::post('ruu_deskripsi_konsepsi', [RuuController::class, 'store_ruu_deskripsi_konsepsi'])->name('ruu.store_ruu_deskripsi_konsepsi');
        Route::put('ruu_deskripsi_konsepsi/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi'])->name('ruu.update_ruu_deskripsi_konsepsi');
        Route::delete('ruu_deskripsi_konsepsi/{id}', [RuuController::class, 'destroy_ruu_deskripsi_konsepsi'])->name('ruu.destroy_ruu_deskripsi_konsepsi');
        Route::get('ruu_deskripsi_konsepsi/{id}/{jenis}/delete', [RuuController::class, 'deleteFile_ruu_deskripsi_konsepsi'])->name('ruu_deskripsi_konsepsi.deleteFile');

        Route::get('ruu_deskripsi_konsepsi/{id}/edit_latar_belakang', [RuuController::class, 'edit_ruu_deskripsi_konsepsi_latar_belakang'])->name('ruu.edit_ruu_deskripsi_konsepsi_latar_belakang');
        Route::put('ruu_deskripsi_konsepsi_latar_belakang/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi_latar_belakang'])->name('ruu.update_ruu_deskripsi_konsepsi_latar_belakang');

        Route::get('ruu_deskripsi_konsepsi/{id}/edit_sasaran', [RuuController::class, 'edit_ruu_deskripsi_konsepsi_sasaran'])->name('ruu.edit_ruu_deskripsi_konsepsi_sasaran');
        Route::put('ruu_deskripsi_konsepsi_sasaran/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi_sasaran'])->name('ruu.update_ruu_deskripsi_konsepsi_sasaran');

        Route::get('ruu_deskripsi_konsepsi/{id}/edit_jangkauan', [RuuController::class, 'edit_ruu_deskripsi_konsepsi_jangkauan'])->name('ruu.edit_ruu_deskripsi_konsepsi_jangkauan');
        Route::put('ruu_deskripsi_konsepsi_jangkauan/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi_jangkauan'])->name('ruu.update_ruu_deskripsi_konsepsi_jangkauan');

        Route::get('ruu_deskripsi_konsepsi/{id}/edit_dasar_pembentukan', [RuuController::class, 'edit_ruu_deskripsi_konsepsi_dasar_pembentukan'])->name('ruu.edit_ruu_deskripsi_konsepsi_dasar_pembentukan');
        Route::put('ruu_deskripsi_konsepsi_dasar_pembentukan/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi_dasar_pembentukan'])->name('ruu.update_ruu_deskripsi_konsepsi_dasar_pembentukan');

        Route::get('ruu_deskripsi_konsepsi/{id}/edit_sejarah_ruu', [RuuController::class, 'edit_ruu_deskripsi_konsepsi_sejarah_ruu'])->name('ruu.edit_ruu_deskripsi_konsepsi_sejarah_ruu');
        Route::put('ruu_deskripsi_konsepsi_sejarah_ruu/{id}', [RuuController::class, 'update_ruu_deskripsi_konsepsi_sejarah_ruu'])->name('ruu.update_ruu_deskripsi_konsepsi_sejarah_ruu');


        Route::resource('feedback', FeedbackController::class);

        Route::resource('ruu_riwayat', Ruu_riwayatController::class);
        Route::delete('ruu_riwayat_prioritas/tahun/{tahun}/revisi/{revisi}', [Ruu_riwayatController::class, 'destroy_prioritas'])->name('ruu_riwayat.destroy_prioritas');

        Route::get('ruu_riwayat/tahun/{tahun}/revisi/{revisi}/edit', [Ruu_riwayatController::class, 'edit'])->name('ruu_riwayat.edit_prioritas');
        Route::put('ruu_riwayat/tahun/{tahun}/revisi/{revisi}', [Ruu_riwayatController::class, 'update_ruu_prioritas'])->name('ruu.update_ruu_prioritas');
        Route::delete('ruu_riwayat/tahun/{tahun}/revisi/{revisi}', [Ruu_riwayatController::class, 'destroy_ruu_prioritas'])->name('ruu_riwayat.destroy_ruu_prioritas');

        Route::get('ruu_riwayat/tahun/{tahun}/revisi/{revisi}/id_periode_prolegnas/{id_periode_prolegnas}/create_ruu_prioritas', [Ruu_riwayatController::class, 'create_ruu_prioritas'])->name('ruu_riwayat.create_ruu_prioritas');


        Route::resource('ruu_longlist', Ruu_longlistController::class);
        Route::delete('ruu_riwayat_longlist/id_periode_prolegnas/{id_periode_prolegnas}/revisi/{revisi}', [Ruu_longlistController::class, 'destroy_longlist'])->name('ruu_riwayat.destroy_longlist');

        Route::get('ruu_longlist/id_periode_prolegnas/{id_periode_prolegnas}/revisi/{revisi}/edit', [Ruu_longlistController::class, 'edit'])->name('ruu_longlist.edit_longlist');
        Route::put('ruu_longlist/id_periode_prolegnas/{id_periode_prolegnas}/revisi/{revisi}', [Ruu_longlistController::class, 'update_ruu_longlist'])->name('ruu.update_ruu_longlist');
        Route::delete('ruu_longlist/id_periode_prolegnas/{id_periode_prolegnas}/revisi/{revisi}', [Ruu_longlistController::class, 'destroy_ruu_longlist'])->name('ruu_longlist.destroy_ruu_longlist');

        Route::get('ruu_longlist/id_periode_prolegnas/{id_periode_prolegnas}/revisi/{revisi}/create_ruu_longlist', [Ruu_longlistController::class, 'create_ruu_longlist'])->name('ruu_longlist.create_ruu_longlist');


});
