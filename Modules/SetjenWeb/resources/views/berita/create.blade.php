@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.berita.index') }}">Daftar Berita</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Berita</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <input type="hidden" class="form-control w-50" id="id_website_menu" name="id_website_menu"
                            value="{{ $website_menu->id }}">
                        <input type="hidden" class="form-control w-50" id="id_menu" name="id_menu"
                            value="{{ $website_menu->id_menu }}">
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label fw-bold">Thumbnail Berita</label>
                            <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail"
                                accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-50 " id="tanggal" name="tanggal"
                            value="" placeholder="Pilih Tanggal">
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

                        </div>
                        <input type="hidden" id="editor_input" name="deskripsi">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control w-50" id="slug" name="slug"
                            value="" placeholder="Masukan Tempat">
                    </div>
                    <div class="mb-3">
                        <label for="status_publikasi" class="form-label fw-bold">Status Publikasi</label>
                        <select class="form-control w-50" id="status_publikasi" name="status_publikasi">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
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
