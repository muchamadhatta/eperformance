@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.statik.index') }}">Daftar Statik</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Statik</h4>
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

                <form action="{{ route('setjenweb.statik.update', $statik->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                        @if ($statik->thumbnail)
                            <br>
                            <img class="mb-3 border " src="{{ asset($statik->thumbnail) }}" alt="Gambar"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.statik.deleteFile', ['id' => $statik->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail"
                                accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="Judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $statik->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="statik_id" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="statik_id" id="statik_id" cols="30" rows="3">{{ $statik->statik_id }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control w-50" id="kategori" name="kategori"
                            value="{{ $statik->kategori }}" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="sub_judul" class="form-label fw-bold">Sub Judul</label>
                        <input type="text" class="form-control w-50" id="sub_judul" name="sub_judul"
                            value="{{ $statik->sub_judul }}" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="id_menu" class="form-label fw-bold">Menu</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_menu" id="id_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($menus as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $statik->id_menu ? 'selected' : '' }}>{{ $data->judul }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#TambahDataModal">Tambah
                Data</button>
            <a href="{{ route('setjenweb.statik.index') }}" class="btn btn-secondary">Kembali</a>

        </div>
    </div>

    <!-- Edit Data  -->
    <!-- Modal Tambah Data  -->
    <div class="modal fade" id="TambahDataModal" tabindex="-1" aria-labelledby="TambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="TambahDataModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setjenweb.statik.store_statik_data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control w-50" id="parent" name="parent"
                            value="{{ $statik->id }}" >
                        <input type="hidden" class="form-control w-50" id="id_website" name="id_website"
                            value="{{ $statik->id_website }}">
                        <input type="hidden" class="form-control w-50" id="id_menu" name="id_menu"
                            value="{{ $statik->id_menu }}">


                            <div class="mb-3">
                                <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                                    <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail"
                                        accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="judul"
                                    class="form-label fw-bold">Judul</label>
                                <font color="red">*</font>
                                <input type="text" class="form-control w-50"
                                    id="judul" name="judul"
                                    placeholder="Masukan Judul"
                                    value="" >
                            </div>

                            <div class="mb-3">
                                <label for="statik_id" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control w-50" name="statik_id" id="statik_id" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="icon" class="form-label fw-bold">Icon</label>
                                <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="url"
                                    class="form-label fw-bold">URL</label>
                                <font color="red">*</font>
                                <input type="text" class="form-control w-50"
                                    id="url" name="url"
                                    placeholder="Masukan URL"
                                    value="" >
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
    <!-- Modal Tambah Data  -->


    @if ($datas->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data</strong> tidak ditemukan.
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
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Deskripsi</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                @if ($statik->id == $data->parent)
                                    <tr>
                                        <td class="text-center">{{ $nomor++ }}</td>
                                        <td class="text-center">{{ $data->judul }}</td>
                                        <td class="text-center">{{ $data->statik_id }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#EditDataModal_{{ $data->id }}">Edit</button>

                                            <a href="{{ route('setjenweb.statik.destroy_statik_data', $data->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $data->id }}"
                                                action="{{ route('setjenweb.statik.destroy_statik_data', $data->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data  -->
                                    <div class="modal fade" id="EditDataModal_{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="EditDataModalLabel_{{ $data->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="EditDataModalLabel_{{ $data->id }}">
                                                        Edit Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('setjenweb.statik.update_statik_data', $data->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')


                                                        <div class="mb-3">
                                                            <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                                                            @if ($data->thumbnail)
                                                                <br>
                                                                <img class="mb-3 border " src="{{ asset($data->thumbnail) }}" alt="Gambar"
                                                                    style="max-height: 100px;">
                                                                <br>
                                                                <a href="{{ route('setjenweb.statik.deleteFile', ['id' => $data->id, 'jenis' => 'img']) }}"
                                                                    class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                                                            @else
                                                                <input type="file" class="form-control w-50" id="thumbnail" name="thumbnail"
                                                                    accept="image/*">
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="judul"
                                                                class="form-label fw-bold">Judul</label>
                                                            <font color="red">*</font>
                                                            <input type="text" class="form-control w-50"
                                                                id="judul" name="judul"
                                                                placeholder="Masukan Judul"
                                                                value="{{ $data->judul }}" >
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="statik_id" class="form-label fw-bold">Deskripsi</label>
                                                            <textarea class="form-control w-50" name="statik_id" id="statik_id" cols="30" rows="3">{{ $data->statik_id }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="icon" class="form-label fw-bold">Icon</label>
                                                            <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3">{{ $data->icon }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="url"
                                                                class="form-label fw-bold">URL</label>
                                                            <font color="red">*</font>
                                                            <input type="text" class="form-control w-50"
                                                                id="url" name="url"
                                                                placeholder="Masukan URL"
                                                                value="{{ $data->url }}">
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
                                    <!-- End Modal Edit Data  -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div><!-- table-responsive -->
            </div><!-- card-body -->

        </div>
    @endif

    <!-- Edit Data  -->

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
