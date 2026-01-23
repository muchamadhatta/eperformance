@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.galeri.index') }}">Daftar Galeri</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Galeri</h4>
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

                <form action="{{ route('setjenweb.galeri.update', $galeri->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="thumbnail_name" class="form-label fw-bold">Thumbnail Galeri</label>
                        @if ($galeri->thumbnail_name)
                            <br>
                            <img class="mb-3 border " src="{{ asset($galeri->thumbnail_name) }}" alt="Gambar"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.galeri.deleteFile', ['id' => $galeri->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="thumbnail_name" name="thumbnail_name"
                                accept="image/*">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $galeri->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-50 " id="tanggal" name="tanggal"
                            value="{{ date('m/d/Y', strtotime($galeri->tanggal)) }}" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3  w-50">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <div id="toolbar-container">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-script" value="sub"></button>
                                <button class="ql-script" value="super"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                                <button class="ql-formula"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="editor-container" class="ht-250">
                            {!! $galeri->deskripsi !!}
                        </div>
                        <input type="hidden" id="editor_input" name="deskripsi">
                    </div>
                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
        </div>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#TambahFotoModal">Tambah
                Foto</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#TambahVideoModal">Tambah
                Video</button>
            <a href="{{ route('setjenweb.galeri.index') }}" class="btn btn-secondary">Kembali</a>

        </div>
    </div>

    <!-- Edit Foto Galeri -->
    <!-- Modal Tambah Foto Galeri -->
    <div class="modal fade" id="TambahFotoModal" tabindex="-1" aria-labelledby="TambahFotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="TambahFotoModalLabel">Tambah Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setjenweb.galeri.store_galeri_foto') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control w-50" id="id_album" name="id_album"
                            value="{{ $galeri->id }}" required>
                        <input type="hidden" class="form-control w-50" id="id_website" name="id_website"
                            value="{{ $galeri->id_website }}" required>

                        <div class="mb-3">
                            <label for="file_name" class="form-label fw-bold">Foto</label>
                            <font color="red">*</font>
                            <input type="file" class="form-control w-50" id="file_name" name="file_name[]" multiple>
                            <p class="text-danger"><small>Dapat Upload Beberapa Foto Sekaligus</small></p>
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">Judul</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="judul" name="judul"
                                placeholder="Masukan Judul" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="deskripsi" name="deskripsi"
                                placeholder="Masukan Deskripsi" value="" required>
                        </div>

                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Foto Galeri -->


    @if ($fotos->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Foto</strong> tidak ditemukan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <!-- row -->
        <div class="card mb-3">
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

                <div class="table-responsive">
                    <table id="tableGrid3">
                        <thead>
                            <tr>
                                <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                                <th scope="col" class="p-1 text-center" style="width: 15%;">Foto</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fotos as $foto)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($foto->file_name)
                                            <img src="{{ asset($foto->file_name) }}" alt="Album"
                                                style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $foto->judul }}</td>
                                    <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#EditFotoModal_{{ $foto->id }}">Edit</button>


                                            <a href="{{ route('setjenweb.galeri.destroy_galeri_foto', $foto->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $foto->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $foto->id }}"
                                                action="{{ route('setjenweb.galeri.destroy_galeri_foto', $foto->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($foto->file_name)
                                                <a href="{{ asset($foto->file_name) }}" download
                                                    class="btn btn-warning"><i
                                                        class="ri-file-download-line"></i>Download</a>
                                            @endif

                                    </td>
                                </tr>

                                <!-- Modal Edit Foto Galeri -->
                                <div class="modal fade" id="EditFotoModal_{{ $foto->id }}" tabindex="-1"
                                    aria-labelledby="EditFotoModalLabel_{{ $foto->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="EditFotoModalLabel_{{ $foto->id }}">
                                                    Edit Foto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('setjenweb.galeri.update_galeri_foto', $foto->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="file_name" class="form-label fw-bold">Foto</label>

                                                        @if ($foto->file_name)
                                                            <br>
                                                            <a href="{{ asset($foto->file_name) }}" target="_blank"
                                                                class="btn btn-warning "><i class="ri-file-line"></i>
                                                                Tampilkan Foto</a>

                                                            <a href="#" class="btn btn-success">
                                                                <i class="ri-file-line"></i>
                                                                {{ ceil($foto->file_size / 1024) }} KB
                                                            </a>

                                                            <a href="{{ route('setjenweb.galeri.deleteFoto', ['id' => $foto->id, 'jenis' => 'img']) }}"
                                                                class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                                                Hapus Foto</a>
                                                        @else
                                                            <input type="file" class="form-control w-50"
                                                                id="file_name" name="file_name">
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label fw-bold">Judul</label>
                                                        <font color="red">*</font>
                                                        <input type="text" class="form-control w-50" id="judul"
                                                            name="judul" placeholder="Masukan Judul"
                                                            value="{{ $foto->judul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                                        <font color="red">*</font>
                                                        <input type="text" class="form-control w-50" id="deskripsi"
                                                            name="deskripsi" placeholder="Masukan Deskripsi"
                                                            value="{{ $foto->deskripsi }}" required>
                                                    </div>

                                                    <input type="submit" value="Simpan Perubahan"
                                                        class="btn btn-primary">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Edit Foto Galeri -->
                            @endforeach
                        </tbody>
                    </table>

                </div><!-- table-responsive -->
            </div><!-- card-body -->

        </div>
    @endif

    <!-- Edit Foto Galeri -->


    <!-- Edit Video Galeri -->
    <!-- Modal Tambah Video Galeri -->
    <div class="modal fade" id="TambahVideoModal" tabindex="-1" aria-labelledby="TambahVideoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="TambahVideoModalLabel">Tambah Video</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setjenweb.galeri.store_galeri_video') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control w-50" id="id_album" name="id_album"
                            value="{{ $galeri->id }}" required>
                        <input type="hidden" class="form-control w-50" id="id_website" name="id_website"
                            value="{{ $galeri->id_website }}" required>

                        <div class="mb-3">
                            <label for="thumbnail_name" class="form-label fw-bold">Cover Video</label>
                            <font color="red">*</font>
                            <input type="file" class="form-control w-50" id="thumbnail_name" name="thumbnail_name">
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label fw-bold">Alamat URL Video</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="url" name="url"
                                placeholder="Masukan Alamat Url Video" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">Judul</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="judul" name="judul"
                                placeholder="Masukan Judul" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control w-15 " id="tanggal" name="tanggal"
                                value="" placeholder="Pilih Tanggal">
                        </div>
                        </script>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="deskripsi" name="deskripsi"
                                placeholder="Masukan Deskripsi" value="" required>
                        </div>

                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Video Galeri -->


    @if ($videos->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Video</strong> tidak ditemukan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <!-- row -->
        <div class="card mb-3">
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

                <div class="table-responsive">
                    <table id="tableGrid3">
                        <thead>
                            <tr>
                                <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                                <th scope="col" class="p-1 text-center" style="width: 15%;">Cover Video</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">URL Video</th>
                                <th scope="col" class="p-1 text-center" style="width: 20%;">Judul</th>
                                <th scope="col" class="p-1 text-center" style="width: 10%;">Tanggal</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($video->thumbnail_name)
                                            <img src="{{ asset($video->thumbnail_name) }}" alt="Album"
                                                style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                            $videoId = isset($params['v']) ? $params['v'] : null;
                                        @endphp

                                        @if ($videoId)
                                            <iframe width="200"
                                                src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                                allowfullscreen></iframe>
                                        @else
                                            <p>Invalid YouTube URL</p>
                                        @endif
                                    </td>


                                    <td class="text-center">{{ $video->judul }}</td>
                                    <td class="text-center">{{ $video->tanggal }}</td>
                                    <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#EditVideoModal_{{ $video->id }}">Edit</button>


                                            <a href="{{ route('setjenweb.galeri.destroy_galeri_video', $video->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $video->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $video->id }}"
                                                action="{{ route('setjenweb.galeri.destroy_galeri_video', $video->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($video->thumbnail_name)
                                                <a href="{{ asset($video->thumbnail_name) }}" download
                                                    class="btn btn-warning"><i
                                                        class="ri-file-download-line"></i>Download</a>
                                            @endif
                                    </td>
                                </tr>

                                <!-- Modal Edit Video Galeri -->
                                <div class="modal fade" id="EditVideoModal_{{ $video->id }}" tabindex="-1"
                                    aria-labelledby="EditVideoModalLabel_{{ $video->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="EditVideoModalLabel_{{ $video->id }}">
                                                    Edit Video</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('setjenweb.galeri.update_galeri_video', $video->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="thumbnail_name" class="form-label fw-bold"> Cover
                                                            Video</label>

                                                        @if ($video->thumbnail_name)
                                                            <br>
                                                            <a href="{{ asset($video->thumbnail_name) }}" target="_blank"
                                                                class="btn btn-warning "><i class="ri-file-line"></i>
                                                                Tampilkan Cover Video</a>

                                                            <a href="#" class="btn btn-success">
                                                                <i class="ri-file-line"></i>
                                                                {{ ceil($video->file_size / 1024) }} KB
                                                            </a>

                                                            <a href="{{ route('setjenweb.galeri.deleteVideo', ['id' => $video->id, 'jenis' => 'img']) }}"
                                                                class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                                                Hapus Cover Video</a>
                                                        @else
                                                            <input type="file" class="form-control w-50"
                                                                id="thumbnail_name" name="thumbnail_name">
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="url" class="form-label fw-bold">Alamat URL Video</label>
                                                        <font color="red">*</font>
                                                        <input type="text" class="form-control w-50" id="url"
                                                            name="url" placeholder="Masukan Alamat URL Video"
                                                            value="{{ $video->url }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label fw-bold">Judul</label>
                                                        <font color="red">*</font>
                                                        <input type="text" class="form-control w-50" id="judul"
                                                            name="judul" placeholder="Masukan Judul"
                                                            value="{{ $video->judul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" class="form-control w-15 " id="tanggal"
                                                            name="tanggal" value="{{ $video->tanggal }}"
                                                            placeholder="Pilih Tanggal">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                                        <font color="red">*</font>
                                                        <input type="text" class="form-control w-50" id="deskripsi"
                                                            name="deskripsi" placeholder="Masukan Deskripsi"
                                                            value="{{ $video->deskripsi }}" required>
                                                    </div>

                                                    <input type="submit" value="Simpan Perubahan"
                                                        class="btn btn-primary">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Edit Video Galeri -->
                            @endforeach
                        </tbody>
                    </table>

                </div><!-- table-responsive -->
            </div><!-- card-body -->

        </div>
    @endif

    <!-- Edit Video Galeri -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll("button");

            buttons.forEach(button => {
                button.type = "button";
            });
        });
    </script>
    <script>
        $('#datepicker5').datepicker({
            showButtonPanel: true
        });

        $('#timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>

@endsection
