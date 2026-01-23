@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.layanan.index') }}">Daftar Layanan</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Layanan</h4>
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

                <form action="{{ route('setjenweb.layanan.update', $layanan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $layanan->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="judul_tampil" class="form-label fw-bold">Judul Tampil</label>
                        <input type="text" class="form-control w-50" id="judul_tampil" name="judul_tampil"
                            value="{{ $layanan->judul_tampil }}" placeholder="Masukan Judul Tampil">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control w-50" id="kategori" name="kategori"
                            value="{{ $layanan->kategori }}" placeholder="Masukan Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                        <textarea class="form-control w-50" name="keterangan" id="keterangan" cols="30" rows="3">{{ $layanan->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label fw-bold">Icon</label>
                        <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3">{{ $layanan->icon }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label fw-bold">Link</label>
                        <input type="text" class="form-control w-50" id="link" name="link"
                            value="{{ $layanan->link }}" placeholder="Masukan Link">
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
            <a href="{{ route('setjenweb.layanan.index') }}" class="btn btn-secondary">Kembali</a>

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
                    <form action="{{ route('setjenweb.layanan.store_layanan_data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control w-50" id="parent" name="parent"
                            value="{{ $layanan->id }}" >
                        <input type="hidden" class="form-control w-50" id="id_website" name="id_website"
                            value="{{ $layanan->id_website }}">

                            <div class="mb-3">
                                <label for="judul" class="form-label fw-bold">Judul</label>
                                <input type="text" class="form-control w-50" id="judul" name="judul"
                                    value="" placeholder="Masukan Judul">
                            </div>
                            <div class="mb-3">
                                <label for="judul_tampil" class="form-label fw-bold">Judul Tampil</label>
                                <input type="text" class="form-control w-50" id="judul_tampil" name="judul_tampil"
                                    value="" placeholder="Masukan Judul Tampil">
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label fw-bold">Kategori</label>
                                <input type="text" class="form-control w-50" id="kategori" name="kategori"
                                    value="" placeholder="Masukan Kategori">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                <textarea class="form-control w-50" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="icon" class="form-label fw-bold">Icon</label>
                                <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label fw-bold">Link</label>
                                <input type="text" class="form-control w-50" id="link" name="link"
                                    value="" placeholder="Masukan Link">
                            </div>
                            <div class="mb-3">
                                <label for="id_menu" class="form-label fw-bold">Menu</label>
                                <div class="d-flex flex-row gap-2">
                                    <select class="form-select w-50" name="id_menu" id="id_menu">
                                        <option disabled selected>--Pilih--</option>
                                        @foreach ($menus as $data)
                                            <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                    <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                                </div>
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
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Keterangan</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                @if ($layanan->id == $data->parent)
                                    <tr>
                                        <td class="text-center">{{ $nomor++ }}</td>
                                        <td class="text-center">{{ $data->judul }}</td>
                                        <td class="text-center">{{ $data->keterangan }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#EditDataModal_{{ $data->id }}">Edit</button>

                                            <a href="{{ route('setjenweb.layanan.destroy_layanan_data', $data->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $data->id }}"
                                                action="{{ route('setjenweb.layanan.destroy_layanan_data', $data->id) }}"
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
                                                        action="{{ route('setjenweb.layanan.update_layanan_data', $data->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')


                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label fw-bold">Judul</label>
                                                            <input type="text" class="form-control w-50" id="judul" name="judul"
                                                                value="{{ $data->judul }}" placeholder="Masukan Judul">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judul_tampil" class="form-label fw-bold">Judul Tampil</label>
                                                            <input type="text" class="form-control w-50" id="judul_tampil" name="judul_tampil"
                                                                value="{{ $data->judul_tampil }}" placeholder="Masukan Judul Tampil">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                                                            <input type="text" class="form-control w-50" id="kategori" name="kategori"
                                                                value="{{ $data->kategori }}" placeholder="Masukan Kategori">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                                            <textarea class="form-control w-50" name="keterangan" id="keterangan" cols="30" rows="3">{{ $data->keterangan }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="icon" class="form-label fw-bold">Icon</label>
                                                            <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="3">{{ $data->icon }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="link" class="form-label fw-bold">Link</label>
                                                            <input type="text" class="form-control w-50" id="link" name="link"
                                                                value="{{ $data->link }}" placeholder="Masukan Link">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="id_menu" class="form-label fw-bold">Menu</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <select class="form-select w-50" name="id_menu" id="id_menu">
                                                                    <option disabled selected>--Pilih--</option>
                                                                    @foreach ($menus as $data_menu)
                                                                        <option value="{{ $data_menu->id }}" {{ $data_menu->id == $data->id_menu ? 'selected' : '' }}>{{ $data_menu->judul }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                                                            </div>
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
