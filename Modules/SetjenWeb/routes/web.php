<?php

use Modules\SetjenWeb\App\Http\Controllers\SetjenWebController;
use Modules\SetjenWeb\App\Http\Controllers\MenuController;
use Modules\SetjenWeb\App\Http\Controllers\TujuanAgendaController;
use Modules\SetjenWeb\App\Http\Controllers\PegawaiController;
use Modules\SetjenWeb\App\Http\Controllers\WebsiteMenuController;
use Modules\SetjenWeb\App\Http\Controllers\AgendaController;
use Modules\SetjenWeb\App\Http\Controllers\BeritaController;
use Modules\SetjenWeb\App\Http\Controllers\GaleriController;
use Modules\SetjenWeb\App\Http\Controllers\BillboardController;
use Modules\SetjenWeb\App\Http\Controllers\PublikasiController;
use Modules\SetjenWeb\App\Http\Controllers\JenisDokumenController;
use Modules\SetjenWeb\App\Http\Controllers\WebsiteController;
use Modules\SetjenWeb\App\Http\Controllers\StatikController;
use Modules\SetjenWeb\App\Http\Controllers\OrganisasiController;

use Modules\SetjenWeb\App\Http\Controllers\AduanWbsController;
use Modules\SetjenWeb\App\Http\Controllers\KomentarController;
use Modules\SetjenWeb\App\Http\Controllers\LayananController;
use Modules\SetjenWeb\App\Http\Controllers\MouController;
use Modules\SetjenWeb\App\Http\Controllers\OutputController;
use Modules\SetjenWeb\App\Http\Controllers\PengajarController;
use Modules\SetjenWeb\App\Http\Controllers\PollsController;
use Modules\SetjenWeb\App\Http\Controllers\ProvinsiController;
use Modules\SetjenWeb\App\Http\Controllers\SdmController;
use Modules\SetjenWeb\App\Http\Controllers\TautanController;
use Modules\SetjenWeb\App\Http\Controllers\TestimonialController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setjenweb', 'middleware' => 'check.id.website.session'], function () {

    Route::get('/', [SetjenWebController::class, 'index'])->name('setjenweb.index');

    Route::get('/menu', [MenuController::class, 'index'])->name('setjenweb.menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('setjenweb.menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('setjenweb.menu.store');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('setjenweb.menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('setjenweb.menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('setjenweb.menu.destroy');

    Route::get('/tujuan_agenda', [TujuanAgendaController::class, 'index'])->name('setjenweb.tujuan_agenda.index');
    Route::get('/tujuan_agenda/create', [TujuanAgendaController::class, 'create'])->name('setjenweb.tujuan_agenda.create');
    Route::post('/tujuan_agenda', [TujuanAgendaController::class, 'store'])->name('setjenweb.tujuan_agenda.store');
    Route::get('/tujuan_agenda/{id}/edit', [TujuanAgendaController::class, 'edit'])->name('setjenweb.tujuan_agenda.edit');
    Route::put('/tujuan_agenda/{id}', [TujuanAgendaController::class, 'update'])->name('setjenweb.tujuan_agenda.update');
    Route::delete('/tujuan_agenda/{id}', [TujuanAgendaController::class, 'destroy'])->name('setjenweb.tujuan_agenda.destroy');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('setjenweb.pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('setjenweb.pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('setjenweb.pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('setjenweb.pegawai.edit');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('setjenweb.pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('setjenweb.pegawai.destroy');
    Route::get('pegawai/{id}/{jenis}/delete', [PegawaiController::class, 'deleteFile'])->name('setjenweb.pegawai.deleteFile');

    Route::get('/website_menu', [WebsiteMenuController::class, 'index'])->name('setjenweb.website_menu.index');
    Route::get('/website_menu/create', [WebsiteMenuController::class, 'create'])->name('setjenweb.website_menu.create');
    Route::post('/website_menu', [WebsiteMenuController::class, 'store'])->name('setjenweb.website_menu.store');
    Route::get('/website_menu/{id}/edit', [WebsiteMenuController::class, 'edit'])->name('setjenweb.website_menu.edit');
    Route::put('/website_menu/{id}', [WebsiteMenuController::class, 'update'])->name('setjenweb.website_menu.update');
    Route::delete('/website_menu/{id}', [WebsiteMenuController::class, 'destroy'])->name('setjenweb.website_menu.destroy');


    Route::get('/agenda', [AgendaController::class, 'index'])->name('setjenweb.agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('setjenweb.agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('setjenweb.agenda.store');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('setjenweb.agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('setjenweb.agenda.update');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('setjenweb.agenda.destroy');

    Route::get('/berita', [BeritaController::class, 'index'])->name('setjenweb.berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('setjenweb.berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('setjenweb.berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('setjenweb.berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('setjenweb.berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('setjenweb.berita.destroy');
    Route::get('berita/{id}/{jenis}/delete', [BeritaController::class, 'deleteThumbnail'])->name('setjenweb.berita.deleteThumbnail');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('setjenweb.galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('setjenweb.galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('setjenweb.galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('setjenweb.galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('setjenweb.galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('setjenweb.galeri.destroy');

    Route::get('galeri/{id}/{jenis}/delete', [GaleriController::class, 'deleteFile'])->name('setjenweb.galeri.deleteFile');

    // Foto Galeri
    Route::post('foto', [GaleriController::class, 'store_galeri_foto'])->name('setjenweb.galeri.store_galeri_foto');

    Route::put('foto/{id}', [GaleriController::class, 'update_galeri_foto'])->name('setjenweb.galeri.update_galeri_foto');

    Route::delete('foto/{id}', [GaleriController::class, 'destroy_galeri_foto'])->name('setjenweb.galeri.destroy_galeri_foto');

    Route::get('foto/{id}/{jenis}/delete', [GaleriController::class, 'deleteFoto'])->name('setjenweb.galeri.deleteFoto');

    // video Galeri
    Route::post('video', [GaleriController::class, 'store_galeri_video'])->name('setjenweb.galeri.store_galeri_video');

    Route::put('video/{id}', [GaleriController::class, 'update_galeri_video'])->name('setjenweb.galeri.update_galeri_video');

    Route::delete('video/{id}', [GaleriController::class, 'destroy_galeri_video'])->name('setjenweb.galeri.destroy_galeri_video');

    Route::get('video/{id}/{jenis}/delete', [GaleriController::class, 'deleteVideo'])->name('setjenweb.galeri.deleteVideo');


    Route::get('/billboard', [BillboardController::class, 'index'])->name('setjenweb.billboard.index');
    Route::get('/billboard/create', [BillboardController::class, 'create'])->name('setjenweb.billboard.create');
    Route::post('/billboard', [BillboardController::class, 'store'])->name('setjenweb.billboard.store');
    Route::get('/billboard/{id}/edit', [BillboardController::class, 'edit'])->name('setjenweb.billboard.edit');
    Route::put('/billboard/{id}', [BillboardController::class, 'update'])->name('setjenweb.billboard.update');
    Route::delete('/billboard/{id}', [BillboardController::class, 'destroy'])->name('setjenweb.billboard.destroy');
    Route::get('billboard/{id}/{jenis}/delete', [BillboardController::class, 'deleteFile'])->name('setjenweb.billboard.deleteFile');

    Route::get('/publikasi', [PublikasiController::class, 'index'])->name('setjenweb.publikasi.index');
    Route::get('/publikasi/create', [PublikasiController::class, 'create'])->name('setjenweb.publikasi.create');
    Route::post('/publikasi', [PublikasiController::class, 'store'])->name('setjenweb.publikasi.store');
    Route::get('/publikasi/{id}/edit', [PublikasiController::class, 'edit'])->name('setjenweb.publikasi.edit');
    Route::put('/publikasi/{id}', [PublikasiController::class, 'update'])->name('setjenweb.publikasi.update');
    Route::delete('/publikasi/{id}', [PublikasiController::class, 'destroy'])->name('setjenweb.publikasi.destroy');
    Route::get('publikasi/{id}/{jenis}/delete', [PublikasiController::class, 'deleteFile'])->name('setjenweb.publikasi.deleteFile');


    Route::get('/jenis_dokumen', [JenisDokumenController::class, 'index'])->name('setjenweb.jenis_dokumen.index');
    Route::get('/jenis_dokumen/create', [JenisDokumenController::class, 'create'])->name('setjenweb.jenis_dokumen.create');
    Route::post('/jenis_dokumen', [JenisDokumenController::class, 'store'])->name('setjenweb.jenis_dokumen.store');
    Route::get('/jenis_dokumen/{id}/edit', [JenisDokumenController::class, 'edit'])->name('setjenweb.jenis_dokumen.edit');
    Route::put('/jenis_dokumen/{id}', [JenisDokumenController::class, 'update'])->name('setjenweb.jenis_dokumen.update');
    Route::delete('/jenis_dokumen/{id}', [JenisDokumenController::class, 'destroy'])->name('setjenweb.jenis_dokumen.destroy');


    Route::get('/website', [WebsiteController::class, 'index'])->name('setjenweb.website.index');
    Route::get('/website/{id}/edit', [WebsiteController::class, 'edit'])->name('setjenweb.website.edit');
    Route::put('/website/{id}', [WebsiteController::class, 'update'])->name('setjenweb.website.update');
    Route::get('website/{id}/{jenis}/delete', [WebsiteController::class, 'deleteFile'])->name('setjenweb.website.deleteFile');

    Route::get('/statik', [StatikController::class, 'index'])->name('setjenweb.statik.index');
    Route::get('/statik/create', [StatikController::class, 'create'])->name('setjenweb.statik.create');
    Route::post('/statik', [StatikController::class, 'store'])->name('setjenweb.statik.store');
    Route::get('/statik/{id}/edit', [StatikController::class, 'edit'])->name('setjenweb.statik.edit');
    Route::put('/statik/{id}', [StatikController::class, 'update'])->name('setjenweb.statik.update');
    Route::delete('/statik/{id}', [StatikController::class, 'destroy'])->name('setjenweb.statik.destroy');
    Route::get('statik/{id}/{jenis}/delete', [StatikController::class, 'deleteFile'])->name('setjenweb.statik.deleteFile');


    // Data Statik
    Route::post('statik_data', [StatikController::class, 'store_statik_data'])->name('setjenweb.statik.store_statik_data');
    Route::put('statik_data/{id}', [StatikController::class, 'update_statik_data'])->name('setjenweb.statik.update_statik_data');
    Route::delete('statik_data/{id}', [StatikController::class, 'destroy_statik_data'])->name('setjenweb.statik.destroy_statik_data');
    // Route::get('statik_data/{id}/{jenis}/delete', [StatikController::class, 'deleteFileDataStatik'])->name('setjenweb.statik_data.deleteFile');

    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('setjenweb.organisasi.index');
    Route::get('/organisasi/create', [OrganisasiController::class, 'create'])->name('setjenweb.organisasi.create');
    Route::post('/organisasi', [OrganisasiController::class, 'store'])->name('setjenweb.organisasi.store');
    Route::get('/organisasi/{id}/edit', [OrganisasiController::class, 'edit'])->name('setjenweb.organisasi.edit');
    Route::put('/organisasi/{id}', [OrganisasiController::class, 'update'])->name('setjenweb.organisasi.update');
    Route::delete('/organisasi/{id}', [OrganisasiController::class, 'destroy'])->name('setjenweb.organisasi.destroy');

    // Data Organisasi
    Route::post('organisasi_data', [OrganisasiController::class, 'store_organisasi_data'])->name('setjenweb.organisasi.store_organisasi_data');
    Route::put('organisasi_data/{id}', [OrganisasiController::class, 'update_organisasi_data'])->name('setjenweb.organisasi.update_organisasi_data');
    Route::delete('organisasi_data/{id}', [OrganisasiController::class, 'destroy_organisasi_data'])->name('setjenweb.organisasi.destroy_organisasi_data');


    Route::get('/aduan_wbs', [AduanWbsController::class, 'index'])->name('setjenweb.aduan_wbs.index');
    Route::get('/aduan_wbs/create', [AduanWbsController::class, 'create'])->name('setjenweb.aduan_wbs.create');
    Route::post('/aduan_wbs', [AduanWbsController::class, 'store'])->name('setjenweb.aduan_wbs.store');
    Route::get('/aduan_wbs/{id}/edit', [AduanWbsController::class, 'edit'])->name('setjenweb.aduan_wbs.edit');
    Route::put('/aduan_wbs/{id}', [AduanWbsController::class, 'update'])->name('setjenweb.aduan_wbs.update');
    Route::delete('/aduan_wbs/{id}', [AduanWbsController::class, 'destroy'])->name('setjenweb.aduan_wbs.destroy');
    Route::get('aduan_wbs/{id}/{jenis}/delete', [AduanWbsController::class, 'deleteFile'])->name('setjenweb.aduan_wbs.deleteFile');

    Route::get('/komentar', [KomentarController::class, 'index'])->name('setjenweb.komentar.index');
    Route::get('/komentar/create', [KomentarController::class, 'create'])->name('setjenweb.komentar.create');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('setjenweb.komentar.store');
    Route::get('/komentar/{id}/edit', [KomentarController::class, 'edit'])->name('setjenweb.komentar.edit');
    Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('setjenweb.komentar.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('setjenweb.komentar.destroy');
    Route::get('komentar/{id}/{jenis}/delete', [KomentarController::class, 'deleteFile'])->name('setjenweb.komentar.deleteFile');


    Route::get('/layanan', [LayananController::class, 'index'])->name('setjenweb.layanan.index');
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('setjenweb.layanan.create');
    Route::post('/layanan', [LayananController::class, 'store'])->name('setjenweb.layanan.store');
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('setjenweb.layanan.edit');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('setjenweb.layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('setjenweb.layanan.destroy');

    // Data Layanan
    Route::post('layanan_data', [LayananController::class, 'store_layanan_data'])->name('setjenweb.layanan.store_layanan_data');
    Route::put('layanan_data/{id}', [LayananController::class, 'update_layanan_data'])->name('setjenweb.layanan.update_layanan_data');
    Route::delete('layanan_data/{id}', [LayananController::class, 'destroy_layanan_data'])->name('setjenweb.layanan.destroy_layanan_data');

    Route::get('/mou', [MouController::class, 'index'])->name('setjenweb.mou.index');
    Route::get('/mou/create', [MouController::class, 'create'])->name('setjenweb.mou.create');
    Route::post('/mou', [MouController::class, 'store'])->name('setjenweb.mou.store');
    Route::get('/mou/{id}/edit', [MouController::class, 'edit'])->name('setjenweb.mou.edit');
    Route::put('/mou/{id}', [MouController::class, 'update'])->name('setjenweb.mou.update');
    Route::delete('/mou/{id}', [MouController::class, 'destroy'])->name('setjenweb.mou.destroy');
    Route::get('mou/{id}/{jenis}/delete', [MouController::class, 'deleteFile'])->name('setjenweb.mou.deleteFile');

    Route::get('/output', [OutputController::class, 'index'])->name('setjenweb.output.index');
    Route::get('/output/create', [OutputController::class, 'create'])->name('setjenweb.output.create');
    Route::post('/output', [OutputController::class, 'store'])->name('setjenweb.output.store');
    Route::get('/output/{id}/edit', [OutputController::class, 'edit'])->name('setjenweb.output.edit');
    Route::put('/output/{id}', [OutputController::class, 'update'])->name('setjenweb.output.update');
    Route::delete('/output/{id}', [OutputController::class, 'destroy'])->name('setjenweb.output.destroy');
    Route::get('output/{id}/{jenis}/delete', [OutputController::class, 'deleteFile'])->name('setjenweb.output.deleteFile');

    Route::get('/pengajar', [PengajarController::class, 'index'])->name('setjenweb.pengajar.index');
    Route::get('/pengajar/create', [PengajarController::class, 'create'])->name('setjenweb.pengajar.create');
    Route::post('/pengajar', [PengajarController::class, 'store'])->name('setjenweb.pengajar.store');
    Route::get('/pengajar/{id}/edit', [PengajarController::class, 'edit'])->name('setjenweb.pengajar.edit');
    Route::put('/pengajar/{id}', [PengajarController::class, 'update'])->name('setjenweb.pengajar.update');
    Route::delete('/pengajar/{id}', [PengajarController::class, 'destroy'])->name('setjenweb.pengajar.destroy');
    Route::get('pengajar/{id}/{jenis}/delete', [PengajarController::class, 'deleteFile'])->name('setjenweb.pengajar.deleteFile');

    Route::get('/polls', [PollsController::class, 'index'])->name('setjenweb.polls.index');
    Route::get('/polls/create', [PollsController::class, 'create'])->name('setjenweb.polls.create');
    Route::post('/polls', [PollsController::class, 'store'])->name('setjenweb.polls.store');
    Route::get('/polls/{id}/edit', [PollsController::class, 'edit'])->name('setjenweb.polls.edit');
    Route::put('/polls/{id}', [PollsController::class, 'update'])->name('setjenweb.polls.update');
    Route::delete('/polls/{id}', [PollsController::class, 'destroy'])->name('setjenweb.polls.destroy');

    Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('setjenweb.provinsi.index');
    Route::get('/provinsi/create', [ProvinsiController::class, 'create'])->name('setjenweb.provinsi.create');
    Route::post('/provinsi', [ProvinsiController::class, 'store'])->name('setjenweb.provinsi.store');
    Route::get('/provinsi/{id}/edit', [ProvinsiController::class, 'edit'])->name('setjenweb.provinsi.edit');
    Route::put('/provinsi/{id}', [ProvinsiController::class, 'update'])->name('setjenweb.provinsi.update');
    Route::delete('/provinsi/{id}', [ProvinsiController::class, 'destroy'])->name('setjenweb.provinsi.destroy');

    Route::get('/sdm', [SdmController::class, 'index'])->name('setjenweb.sdm.index');
    Route::get('/sdm/create', [SdmController::class, 'create'])->name('setjenweb.sdm.create');
    Route::post('/sdm', [SdmController::class, 'store'])->name('setjenweb.sdm.store');
    Route::get('/sdm/{id}/edit', [SdmController::class, 'edit'])->name('setjenweb.sdm.edit');
    Route::put('/sdm/{id}', [SdmController::class, 'update'])->name('setjenweb.sdm.update');
    Route::delete('/sdm/{id}', [SdmController::class, 'destroy'])->name('setjenweb.sdm.destroy');

    Route::get('/tautan', [TautanController::class, 'index'])->name('setjenweb.tautan.index');
    Route::get('/tautan/create', [TautanController::class, 'create'])->name('setjenweb.tautan.create');
    Route::post('/tautan', [TautanController::class, 'store'])->name('setjenweb.tautan.store');
    Route::get('/tautan/{id}/edit', [TautanController::class, 'edit'])->name('setjenweb.tautan.edit');
    Route::put('/tautan/{id}', [TautanController::class, 'update'])->name('setjenweb.tautan.update');
    Route::delete('/tautan/{id}', [TautanController::class, 'destroy'])->name('setjenweb.tautan.destroy');

    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('setjenweb.testimonial.index');
    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('setjenweb.testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('setjenweb.testimonial.store');
    Route::get('/testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('setjenweb.testimonial.edit');
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('setjenweb.testimonial.update');
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('setjenweb.testimonial.destroy');
    Route::get('testimonial/{id}/{jenis}/delete', [TestimonialController::class, 'deleteFile'])->name('setjenweb.testimonial.deleteFile');

});
