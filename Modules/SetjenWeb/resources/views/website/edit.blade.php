@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Pengaturan</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.website.index') }}">Website</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Website</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('success-alert').remove();
                    }, 3000);
                </script>
            @endif
            <div class="mb-3">
                <form action="{{ route('setjenweb.website.update', $website->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_website" class="form-label fw-bold">Nama Website</label>
                        <input type="text" class="form-control" id="nama_website" name="nama_website"
                            placeholder="Masukan Nama Website" value="{{ $website->nama_website }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label fw-bold">URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Masukan URL"
                            value="{{ $website->url }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="template" class="form-label fw-bold">Template</label>
                        <input type="text" class="form-control " id="template" name="template"
                            placeholder="Masukan Template" value="{{ $website->template }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="variant" class="form-label fw-bold">Variant</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control" id="variant" name="variant"
                                placeholder="Masukan Variant" value="{{ $website->variant }}" required>
                        </div>
                    </div>


                    <hr class="my-4 border border-primary border-2 ">
                    <div class="mb-3">
                        <label for="identitas" class="form-label fs-5 fw-bold text-bg-info p-2">Identitas</label>

                        <div class="d-flex flex-column gap-2">
                            <div class="mb-3">
                                <label for="judul_short" class="form-label fw-bold">Judul Singkat</label>
                                <input type="text" class="form-control" id="judul_short" name="identitas[judul_short]"
                                    placeholder="Judul Singkat" value="{{ $identitas['judul_short'] ?? '' }}" required>
                            </div>


                            <div class="mb-3">
                                <label for="judul_long" class="form-label fw-bold">Judul Panjang</label>
                                <input type="text" class="form-control" id="judul_long" name="identitas[judul_long]"
                                    placeholder="Judul Panjang" value="{{ $identitas['judul_long'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sub_judul" class="form-label fw-bold">Sub Judul</label>
                                <input type="text" class="form-control" id="sub_judul" name="identitas[sub_judul]"
                                    placeholder="Sub Judul" value="{{ $identitas['sub_judul'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">Alamat</label>
                                <input type="text" class="form-control" id="address" name="identitas[address]"
                                    placeholder="Alamat" value="{{ $identitas['address'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone" name="identitas[phone]"
                                    placeholder="Nomor Telepon" value="{{ $identitas['phone'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="identitas[email]"
                                    placeholder="Email" value="{{ $identitas['email'] ?? '' }}" required>
                            </div>


                            <div class="mb-3">
                                <label for="logo" class="form-label fw-bold">Logo</label>
                                @if (isset($identitas['logo']) && $identitas['logo'])
                                    <br>
                                    <img class="mb-3 border " src="{{ asset($identitas['logo']) }}" alt="Logo"
                                        style="max-height: 100px;">
                                    <br>
                                    <a href="{{ route('setjenweb.website.deleteFile', ['id' => $website->id, 'jenis' => 'img']) }}"
                                        class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>

                                    <input type="hidden" class="form-control w-50" id="logo"
                                        name="identitas[logo]" value="{{ $identitas['logo'] ?? '' }}">
                                @else
                                    <input type="file" class="form-control w-50" id="logo"
                                        name="identitas[logo]" accept="image/*" required>
                                @endif
                            </div>







                            <div class="mb-3">
                                <label for="langitude" class="form-label fw-bold">Latitude dan Longitude</label>
                                @foreach ($identitas['langitude'] as $index => $latlong)
                                    <input type="text" class="form-control mb-3" id="langitude_{{ $index }}"
                                        name="identitas[langitude][]" value="{{ $latlong }}"
                                        placeholder="Masukkan Latitude dan Longitude" required>
                                @endforeach
                            </div>
                        </div>
                    </div>




                    <hr class="my-4 border border-primary border-2 ">
                    <div class="mb-3">
                        <label for="identitas" class="form-label fs-5 fw-bold text-bg-info p-2">Media Sosial</label>

                        <div class="d-flex flex-column gap-2">
                            <div class="mb-3">
                                <label for="facebook" class="form-label fw-bold">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="sosmed[facebook]"
                                    placeholder="Link Facebook" value="{{ $sosmed['facebook'] ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="twitter" class="form-label fw-bold">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="sosmed[twitter]"
                                    placeholder="Link Twitter" value="{{ $sosmed['twitter'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="youtube" class="form-label fw-bold">youtube</label>
                                <input type="text" class="form-control" id="youtube" name="sosmed[youtube]"
                                    placeholder="Link Youtube" value="{{ $sosmed['youtube'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="instagram" class="form-label fw-bold">instagram</label>
                                <input type="text" class="form-control" id="instagram" name="sosmed[instagram]"
                                    placeholder="Link Instagram" value="{{ $sosmed['instagram'] ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tiktok" class="form-label fw-bold">Tiktok</label>
                                <input type="text" class="form-control" id="tiktok" name="sosmed[tiktok]"
                                    placeholder="Link TikTok" value="{{ $sosmed['tiktok'] ?? '' }}" required>
                            </div>
                            <!-- Tambahkan input fields lainnya sesuai dengan kebutuhan -->
                        </div>
                    </div>
                    <hr class="my-4 border border-primary border-2 ">
                    <div class="mb-3">
                        <label for="bannerJudulAgenda" class="form-label fw-bold">Banner Judul Agenda</label>
                        <input type="text" class="form-control" id="bannerJudulAgenda"
                            name="banner[bannerJudulAgenda]" placeholder="Banner Judul Agenda"
                            value="{{ $banner['bannerJudulAgenda'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubJudulAgenda" class="form-label fw-bold">Banner Sub Judul Agenda</label>
                        <input type="text" class="form-control" id="bannerSubJudulAgenda"
                            name="banner[bannerSubJudulAgenda]" placeholder="Banner Sub Judul Agenda"
                            value="{{ $banner['bannerSubJudulAgenda'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerJudulPublikasi" class="form-label fw-bold">Banner Judul Publikasi</label>
                        <input type="text" class="form-control" id="bannerJudulPublikasi"
                            name="banner[bannerJudulPublikasi]" placeholder="Banner Judul Publikasi"
                            value="{{ $banner['bannerJudulPublikasi'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubJudulPublikasi" class="form-label fw-bold">Banner Sub Judul
                            Publikasi</label>
                        <input type="text" class="form-control" id="bannerSubJudulPublikasi"
                            name="banner[bannerSubJudulPublikasi]" placeholder="Banner Sub Judul Publikasi"
                            value="{{ $banner['bannerSubJudulPublikasi'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerJudulProfil" class="form-label fw-bold">Banner Judul Profil</label>
                        <input type="text" class="form-control" id="bannerJudulProfil"
                            name="banner[bannerJudulProfil]" placeholder="Banner Judul Profil"
                            value="{{ $banner['bannerJudulProfil'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubJudulProfil" class="form-label fw-bold">Banner Sub Judul Profil</label>
                        <input type="text" class="form-control" id="bannerSubJudulProfil"
                            name="banner[bannerSubJudulProfil]" placeholder="Banner Sub Judul Profil"
                            value="{{ $banner['bannerSubJudulProfil'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerJudulKontak" class="form-label fw-bold">Banner Judul Kontak</label>
                        <input type="text" class="form-control" id="bannerJudulKontak"
                            name="banner[bannerJudulKontak]" placeholder="Banner Judul Kontak"
                            value="{{ $banner['bannerJudulKontak'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubJudulKontak" class="form-label fw-bold">Banner Sub Judul Kontak</label>
                        <input type="text" class="form-control" id="bannerSubJudulKontak"
                            name="banner[bannerSubJudulKontak]" placeholder="Banner Sub Judul Kontak"
                            value="{{ $banner['bannerSubJudulKontak'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerJudulGaleri" class="form-label fw-bold">Banner Judul Galeri</label>
                        <input type="text" class="form-control" id="bannerJudulGaleri"
                            name="banner[bannerJudulGaleri]" placeholder="Banner Judul Galeri"
                            value="{{ $banner['bannerJudulGaleri'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="bannerSubJudulGaleri" class="form-label fw-bold">Banner Sub Judul Galeri</label>
                        <input type="text" class="form-control" id="bannerSubJudulGaleri"
                            name="banner[bannerSubJudulGaleri]" placeholder="Banner Sub Judul Galeri"
                            value="{{ $banner['bannerSubJudulGaleri'] ?? '' }}" required>
                    </div>


                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
