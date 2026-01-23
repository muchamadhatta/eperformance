@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Pengusul</li>
                <li class="breadcrumb-item"><a href="{{ route('ruu.index') }}">Daftar RUU</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit RUU</h4>
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
            <ul class="nav nav-pills" id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#informasi">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#pengusul">Pengusul</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#deskripsi">Deskripsi Konsepsi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#riwayat">Riwayat No. Urut Prioritas</a>
                </li>
            </ul>
        </div>

        <div class="card-footer">

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="informasi">

                    <form action="{{ route('ruu.update', $ruu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul_ruu" class="form-label fw-bold">Judul RUU</label>
                            <div class="d-flex flex-row gap-2">
                                <input required type="text" class="form-control w-50" id="judul_ruu" name="judul_ruu"
                                    placeholder="Masukan Judul RUU" value="{{ $ruu->judul_ruu }}">
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pengusul" class="form-label fw-bold">Pengusul</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="DPR" id="flexCheckDPR"
                                    name="pengusul[]" {{ in_array('DPR', explode(',', $ruu->pengusul)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDPR">
                                    DPR
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Pemerintah" id="flexCheckPemerintah"
                                    name="pengusul[]"
                                    {{ in_array('Pemerintah', explode(',', $ruu->pengusul)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckPemerintah">
                                    Pemerintah
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="DPD" id="flexCheckDPD"
                                    name="pengusul[]" {{ in_array('DPD', explode(',', $ruu->pengusul)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDPD">
                                    DPD
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pengusulan" class="form-label fw-bold">Tanggal Pengusulan</label>
                            <input id="datepicker5" type="text" class="form-control w-15 bg-secondary text-white "
                                id="tanggal_pengusulan" name="tanggal_pengusulan"
                                value="{{ date('d/m/Y', strtotime($ruu->tanggal_pengusulan)) }}"
                                placeholder="Pilih Tanggal Pengusulan">
                        </div>

                        <div class="mb-3">
                            <label for="id_pembahasan_ruu" class="form-label fw-bold">Pembahasan RUU</label>
                            <div class="d-flex flex-row gap-2">
                                <select class="form-select w-50" name="id_pembahasan_ruu" id="id_pembahasan_ruu">
                                    <option disabled>--Pilih Data--</option>
                                    @foreach ($pembahasan_ruu as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $ruu->id_pembahasan_ruu == $data->id ? 'selected' : '' }}>
                                            {{ $data->tahapan }}
                                            -
                                            {{ $data->penjelasan }}</option>
                                    @endforeach
                                </select>
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_kumulatif" class="form-label fw-bold">Kumulatif</label>
                            <div class="d-flex flex-row gap-2">
                                <select class="form-select w-50" name="id_kumulatif" id="id_kumulatif">
                                    <option disabled>--Pilih Data--</option>
                                    @foreach ($kumulatif as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $ruu->id_kumulatif == $data->id ? 'selected' : '' }}>{{ $data->kumulatif }}
                                        </option>
                                    @endforeach
                                </select>
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_akd" class="form-label fw-bold">Penugasan Pembahasan</label>
                            <div class="d-flex flex-row gap-2">
                                <select class="form-select w-15" name="id_akd" id="id_akd">
                                    <option disabled selected>--Pilih Data--</option>
                                    <option value="0" {{ $ruu->id_akd == 0 ? 'selected' : '' }}>Proses Penyusunan</option>
                                    <option value="1" {{ $ruu->id_akd == 1 ? 'selected' : '' }}>Komisi I</option>
                                    <option value="2" {{ $ruu->id_akd == 2 ? 'selected' : '' }}>Komisi II</option>
                                    <option value="3" {{ $ruu->id_akd == 3 ? 'selected' : '' }}>Komisi III</option>
                                    <option value="4" {{ $ruu->id_akd == 4 ? 'selected' : '' }}>Komisi IV</option>
                                    <option value="5" {{ $ruu->id_akd == 5 ? 'selected' : '' }}>Komisi V</option>
                                    <option value="6" {{ $ruu->id_akd == 6 ? 'selected' : '' }}>Komisi VI</option>
                                    <option value="7" {{ $ruu->id_akd == 7 ? 'selected' : '' }}>Komisi VII</option>
                                    <option value="8" {{ $ruu->id_akd == 8 ? 'selected' : '' }}>Komisi VIII</option>
                                    <option value="9" {{ $ruu->id_akd == 9 ? 'selected' : '' }}>Komisi IX</option>
                                    <option value="10" {{ $ruu->id_akd == 10 ? 'selected' : '' }}>Komisi X</option>
                                    <option value="11" {{ $ruu->id_akd == 11 ? 'selected' : '' }}>Komisi XI</option>
                                    <option value="14" {{ $ruu->id_akd == 14 ? 'selected' : '' }}>Badan Legislasi</option>
                                    <option value="15" {{ $ruu->id_akd == 15 ? 'selected' : '' }}>Badan Anggaran</option>
                                    <option value="20" {{ $ruu->id_akd == 20 ? 'selected' : '' }}>Panitia Khusus</option>
                                </select>
                                <font style=" display: flex; align-items: center; padding: 0;">set_pansus@dpr.go.id</font>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="no_urut_longlist" class="form-label fw-bold">No Urut Longlist</label>
                            <div class="d-flex flex-row gap-2">
                                <input required type="number" class="form-control w-50" id="no_urut_longlist"
                                    name="no_urut_longlist" placeholder="Masukan No Urut Longlist"
                                    value="{{ $ruu->no_urut_longlist }}">
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <div class="d-flex flex-row gap-2">
                                <input required type="text" class="form-control w-50" id="keterangan"
                                    name="keterangan" placeholder="Masukan Keterangan" value="{{ $ruu->keterangan }}">
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email Pansus</label>
                            <div class="d-flex flex-row gap-2">
                                <input  type="email" class="form-control w-50" id="email" name="email"
                                    placeholder="Masukan Keterangan" value="{{ $ruu->email }}">
                                <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                            </div>
                        </div>
                        <input type="submit" value="Simpan Perubahan" class="btn btn-primary ">
                    </form>

                </div>

                <div class="tab-pane fade" id="pengusul">

                    <div class="table-responsive">
                        <table id="tableGrid3">
                            <thead>
                                <tr>
                                    <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                                    <th scope="col" class="p-1 text-center" style="width: 20%;">Pengusul</th>
                                    <th scope="col" class="p-1 text-center" style="width: 25%;">Sub Pengusul</th>
                                    <th scope="col" class="p-1 text-center" style="width: 25%;">Detail Pengusul
                                    </th>
                                    <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruu_pengusuls as $ruu_pengusul)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $ruu_pengusul->pengusul }}</td>
                                        <td>{{ $ruu_pengusul->sub_pengusul }}</td>
                                        <td>{{ $ruu_pengusul->detail_pengusul }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#EditPengusulModal_{{ $ruu_pengusul->id }}"><i
                                                    class="ri-edit-2-line"></i>Edit</button>

                                            <a href="{{ route('ruu.destroy_ruu_pengusul', $ruu_pengusul->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $ruu_pengusul->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $ruu_pengusul->id }}"
                                                action="{{ route('ruu.destroy_ruu_pengusul', $ruu_pengusul->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Pengusul -->
                                    <div class="modal fade" id="EditPengusulModal_{{ $ruu_pengusul->id }}"
                                        tabindex="-1" aria-labelledby="EditPengusulModalLabel_{{ $ruu_pengusul->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="EditPengusulModalLabel_{{ $ruu_pengusul->id }}">Edit Pengusul
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('ruu.update_ruu_pengusul', $ruu_pengusul->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="pengusul"
                                                                class="form-label fw-bold">Pengusul</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <select class="form-select w-50" id="pengusulEDIT"
                                                                    name="pengusul">
                                                                    <option disabled selected>--Pilih Data--</option>
                                                                    <option value="DPR"
                                                                        @if ($ruu_pengusul->pengusul == 'DPR') selected @endif>
                                                                        DPR</option>
                                                                    <option value="PEMERINTAH"
                                                                        @if ($ruu->pengusul == 'PEMERINTAH') selected @endif>
                                                                        PEMERINTAH</option>
                                                                    <option value="DPD"
                                                                        @if ($ruu_pengusul->pengusul == 'DPD') selected @endif>
                                                                        DPD</option>
                                                                </select>
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *</font>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="sub_pengusul" class="form-label fw-bold">Sub
                                                                Pengusul</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <select class="form-select w-50" id="sub_pengusulEDIT"
                                                                    name="sub_pengusul">
                                                                    <option disabled selected>--Pilih Data--</option>
                                                                    <option value="KOMISI"
                                                                        @if ($ruu_pengusul->sub_pengusul == 'KOMISI') selected @endif>
                                                                        KOMISI</option>
                                                                    <option value="FRAKSI"
                                                                        @if ($ruu_pengusul->sub_pengusul == 'FRAKSI') selected @endif>
                                                                        FRAKSI</option>
                                                                    <option value="MASYARAKAT"
                                                                        @if ($ruu_pengusul->sub_pengusul == 'MASYARAKAT') selected @endif>
                                                                        MASYARAKAT</option>
                                                                    <option value="PEMERINTAH"
                                                                        @if ($ruu_pengusul->sub_pengusul == 'PEMERINTAH') selected @endif>
                                                                        PEMERINTAH</option>
                                                                    <option value="DPD"
                                                                        @if ($ruu_pengusul->sub_pengusul == 'DPD') selected @endif>
                                                                        DPD</option>
                                                                </select>
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *</font>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="detail_pengusul" class="form-label fw-bold">Detail
                                                                Pengusul</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <input required type="text" class="form-control w-50"
                                                                    id="detail_pengusul" name="detail_pengusul"
                                                                    placeholder="Masukan Detail Pengusul "
                                                                    value="{{ $ruu_pengusul->detail_pengusul }}">
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *</font>
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
                                    <!-- End Modal Edit Pengusul -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#TambahPengusulModal">Tambah
                            Pengusul</button>
                    </div>
                    <!-- Modal Tambah Pengusul -->
                    <div class="modal fade" id="TambahPengusulModal" tabindex="-1"
                        aria-labelledby="TambahPengusulModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="TambahPengusulModalLabel">Tambah Pengusul</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ruu.store_ruu_pengusul') }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('POST')

                                        <input type="hidden" class="form-control w-50" id="id_ruu" name="id_ruu"
                                            value="{{ $ruu->id }}" required>

                                        <div class="mb-3">
                                            <label for="pengusul" class="form-label fw-bold">Pengusul</label>
                                            <div class="d-flex flex-row gap-2">
                                                <select class="form-select w-50" id="pengusulADD" name="pengusul">
                                                    <option disabled selected>--Pilih Data--</option>
                                                    <option value="DPR">DPR</option>
                                                    <option value="PEMERINTAH">PEMERINTAH</option>
                                                    <option value="DPD">DPD</option>
                                                </select>
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">*
                                                </font>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sub_pengusul" class="form-label fw-bold">Sub Pengusul</label>
                                            <div class="d-flex flex-row gap-2">
                                                <select class="form-select w-50" id="sub_pengusulADD"
                                                    name="sub_pengusul">
                                                </select>
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">*
                                                </font>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="detail_pengusul" class="form-label fw-bold">Detail
                                                Pengusul</label>
                                            <div class="d-flex flex-row gap-2">
                                                <input required type="text" class="form-control w-50"
                                                    id="detail_pengusul" name="detail_pengusul"
                                                    placeholder="Masukan Detail Pengusul " value="">
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">
                                                    *</font>
                                            </div>
                                        </div>

                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tambah Pengusul -->

                </div>
                <div class="tab-pane fade" id="deskripsi">
                    <div class="table-responsive">
                        <table id="tableGrid3">
                            <thead>
                                <tr>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 5%;">No</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">Dokumen
                                    </th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">Latar
                                        Belakang dan
                                        Tujuan Penulisan</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">Sasaran
                                        yang Ingin
                                        Diwujudkan</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">Jangkauan
                                        dan Arahan
                                        Pengaturan</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 15%;">Dasar
                                        Pembentukan</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 15%;">Sejarah
                                        RUU</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 25%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruu_deskripsi_konsepsis as $ruu_deskripsi_konsepsi)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">
                                            <p>{{ $ruu_deskripsi_konsepsi->judul }}</p>
                                            <hr><b class="text-success">{{ $ruu_deskripsi_konsepsi->pengusul }}</b>
                                            <hr>
                                            <p>{{ $ruu_deskripsi_konsepsi->tanggal }}</p>
                                        </td>



                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ route('ruu.edit_ruu_deskripsi_konsepsi_latar_belakang', $ruu_deskripsi_konsepsi->id) }}">
                                                {{ substr($ruu_deskripsi_konsepsi->latar_belakang, 0, 20) }} ...
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ route('ruu.edit_ruu_deskripsi_konsepsi_sasaran', $ruu_deskripsi_konsepsi->id) }}">
                                                {{ substr($ruu_deskripsi_konsepsi->sasaran, 0, 20) }} ...
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ route('ruu.edit_ruu_deskripsi_konsepsi_jangkauan', $ruu_deskripsi_konsepsi->id) }}">
                                                {{ substr($ruu_deskripsi_konsepsi->jangkauan, 0, 20) }} ...
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ route('ruu.edit_ruu_deskripsi_konsepsi_dasar_pembentukan', $ruu_deskripsi_konsepsi->id) }}">
                                                {{ substr($ruu_deskripsi_konsepsi->dasar_pembentukan, 0, 20) }} ...
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ route('ruu.edit_ruu_deskripsi_konsepsi_sejarah_ruu', $ruu_deskripsi_konsepsi->id) }}">
                                                {{ substr($ruu_deskripsi_konsepsi->sejarah_ruu, 0, 20) }} ...
                                        </td>
                                        </a>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal"
                                                data-bs-target="#EditDeskripsiModal_{{ $ruu_deskripsi_konsepsi->id }}"><i
                                                    class="ri-edit-2-line"></i>Edit</button>

                                            <a href="{{ route('ruu.destroy_ruu_deskripsi_konsepsi', $ruu_deskripsi_konsepsi->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $ruu_deskripsi_konsepsi->id }}').submit();"
                                                class="btn btn-danger mt-1">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $ruu_deskripsi_konsepsi->id }}"
                                                action="{{ route('ruu.destroy_ruu_deskripsi_konsepsi', $ruu_deskripsi_konsepsi->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>


                                            @if ($ruu_deskripsi_konsepsi->file_name)
                                                <a href="{{ asset('berkas_sileg/ruu_deskripsi_konsepsi/' . $ruu_deskripsi_konsepsi->file_name) }}"
                                                    download class="btn btn-warning mt-1"><i
                                                        class="ri-file-download-line"></i>Download</a>
                                            @endif

                                        </td>
                                    </tr>

                                    <!-- Modal Edit Deskripsi -->
                                    <div class="modal fade" id="EditDeskripsiModal_{{ $ruu_deskripsi_konsepsi->id }}"
                                        tabindex="-1"
                                        aria-labelledby="EditDeskripsiModalLabel_{{ $ruu_deskripsi_konsepsi->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="EditDeskripsiModalLabel_{{ $ruu_deskripsi_konsepsi->id }}">
                                                        Edit
                                                        Deskripsi Konsepsi
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('ruu.update_ruu_deskripsi_konsepsi', $ruu_deskripsi_konsepsi->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="tanggal"
                                                                class="form-label fw-bold">Tanggal</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <input type="date"
                                                                    class="form-control w-15 bg-secondary text-white "
                                                                    id="tanggal" name="tanggal"
                                                                    value="{{ $ruu_deskripsi_konsepsi->tanggal }}"
                                                                    placeholder="Pilih Tanggal">
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *</font>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label fw-bold">Judul</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <input required type="text" class="form-control w-50"
                                                                    id="judul" name="judul"
                                                                    placeholder="Masukan Judul "
                                                                    value="{{ $ruu_deskripsi_konsepsi->judul }}">
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *</font>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="pengusul"
                                                                class="form-label fw-bold">Pengusul</label>
                                                            <div class="d-flex flex-row gap-2">
                                                                <select class="form-select w-50" id="pengusul"
                                                                    name="pengusul">
                                                                    <option disabled selected>--Pilih Data--</option>
                                                                    <option value="DPR"
                                                                        @if ($ruu_deskripsi_konsepsi->pengusul == 'DPR') selected @endif>
                                                                        DPR</option>
                                                                    <option value="PEMERINTAH"
                                                                        @if ($ruu_deskripsi_konsepsi->pengusul == 'PEMERINTAH') selected @endif>
                                                                        PEMERINTAH</option>
                                                                    <option value="DPD"
                                                                        @if ($ruu_deskripsi_konsepsi->pengusul == 'DPD') selected @endif>
                                                                        DPD</option>
                                                                </select>
                                                                <font
                                                                    style="color: red; display: flex; align-items: center; padding: 0;">
                                                                    *
                                                                </font>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="file_name"
                                                                class="form-label  fw-bold">File</label>

                                                            @if ($ruu_deskripsi_konsepsi->file_name)
                                                                <br>
                                                                <div class="d-flex flex-row gap-2 align-items-start">
                                                                    <a href="{{ asset('berkas_sileg/ruu_deskripsi_konsepsi/' . $ruu_deskripsi_konsepsi->file_name) }}"
                                                                        target="_blank" class="btn btn-success"><i
                                                                            class="ri-eye-line"></i> Lihat</a>
                                                                    <br>
                                                                    <a href="{{ route('ruu_deskripsi_konsepsi.deleteFile', ['id' => $ruu_deskripsi_konsepsi->id, 'jenis' => 'pdf']) }}"
                                                                        class="btn btn-danger"><i
                                                                            class="ri-delete-bin-line"></i> Hapus</a>
                                                                </div>
                                                            @else
                                                                <input type="file" class="form-control w-50 "
                                                                    id="file_name" name="file_name"
                                                                    accept="application/pdf">
                                                            @endif
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
                                    <!-- End Modal Edit Deskripsi -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#TambahDeskripsiModal">Tambah
                            Deskripsi Konsepsi</button>
                    </div>
                    <!-- Modal Tambah Deskripsi -->
                    <div class="modal fade" id="TambahDeskripsiModal" tabindex="-1"
                        aria-labelledby="TambahDeskripsiModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="TambahDeskripsiModalLabel">Tambah Deskripsi Konsepsi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ruu.store_ruu_deskripsi_konsepsi') }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('POST')

                                        <input type="hidden" class="form-control w-50" id="id_ruu" name="id_ruu"
                                            value="{{ $ruu->id }}" required>

                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                                            <div class="d-flex flex-row gap-2">
                                                <input type="date" class="form-control w-15 bg-secondary text-white "
                                                    id="tanggal" name="tanggal" value=""
                                                    placeholder="Pilih Tanggal">
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">
                                                    *</font>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="judul" class="form-label fw-bold">Judul</label>
                                            <div class="d-flex flex-row gap-2">
                                                <input required type="text" class="form-control w-50" id="judul"
                                                    name="judul" placeholder="Masukan Judul " value="">
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">
                                                    *</font>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pengusul" class="form-label fw-bold">Pengusul</label>
                                            <div class="d-flex flex-row gap-2">
                                                <select class="form-select w-50" id="pengusul" name="pengusul">
                                                    <option disabled selected>--Pilih Data--</option>
                                                    <option value="DPR">DPR</option>
                                                    <option value="PEMERINTAH">PEMERINTAH</option>
                                                    <option value="DPD">DPD</option>
                                                </select>
                                                <font style="color: red; display: flex; align-items: center; padding: 0;">*
                                                </font>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="file_name" class="form-label fw-bold">File</label>
                                            <input type="file" class="form-control w-50" id="file_name" name="file_name"
                                                accept="application/pdf">
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
                    <!-- Modal Tambah Deskripsi -->
                </div>


                <div class="tab-pane fade" id="riwayat">
                    <div class="table-responsive">
                        <table id="tableGrid3">
                            <thead>
                                <tr>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 5%;">No</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">Tahun</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 10%;">No. Urut Prioritas</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 45%;">Judul RUU Prioritas</th>
                                    <th scope="col" class="p-1 text-center align-middle" style="width: 30%;">Pengusul Prioritas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruu_riwayats as $ruu_riwayat)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $ruu_riwayat->tahun }}</td>
                                        <td class="text-center align-middle">{{ $ruu_riwayat->no_urut_prioritas }}</td>
                                        <td class="text-center align-middle">{{ $ruu_riwayat->judul_ruu_prioritas }}</td>
                                        <td class="text-center align-middle">{{ $ruu_riwayat->pengusul_prioritas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <script>
        $(document).ready(function() {
            console.log("Document ready!");
            $('[id="datepicker5"]').datepicker({
                showButtonPanel: true
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mengambil semua link tab
            var tabLinks = document.querySelectorAll('.nav-pills .nav-link');

            // Menambahkan event listener untuk setiap link tab
            tabLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Menghentikan default behavior dari link

                    // Menghapus class 'active' dari semua link tab
                    tabLinks.forEach(function(item) {
                        item.classList.remove('active');
                    });

                    // Menambahkan class 'active' ke link yang diklik
                    this.classList.add('active');

                    // Mengambil target tab content berdasarkan href
                    var target = this.getAttribute('href');

                    // Menghapus class 'show active' dari semua tab content
                    document.querySelectorAll('.tab-pane').forEach(function(tabContent) {
                        tabContent.classList.remove('show', 'active');
                    });

                    // Menambahkan class 'show active' ke tab content yang sesuai dengan target
                    document.querySelector(target).classList.add('show', 'active');
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pengusulDropdown = document.getElementById("pengusulADD");
            var subPengusulDropdown = document.getElementById("sub_pengusulADD");

            pengusulDropdown.addEventListener("change", function() {
                var pengusulValue = pengusulDropdown.value;
                subPengusulDropdown.innerHTML = ""; // Bersihkan opsi yang ada sebelumnya

                if (pengusulValue === "DPR") {
                    // Jika yang dipilih DPR, tambahkan opsi yang sesuai
                    var options = ["KOMISI", "FRAKSI", "MASYARAKAT"];
                    options.forEach(function(option) {
                        var optionElement = document.createElement("option");
                        optionElement.value = option;
                        optionElement.textContent = option;
                        subPengusulDropdown.appendChild(optionElement);
                    });
                } else if (pengusulValue === "PEMERINTAH") {
                    // Jika yang dipilih PEMERINTAH, tambahkan opsi yang sesuai
                    var optionElement = document.createElement("option");
                    optionElement.value = "PEMERINTAH";
                    optionElement.textContent = "PEMERINTAH";
                    subPengusulDropdown.appendChild(optionElement);
                } else if (pengusulValue === "DPD") {
                    // Jika yang dipilih DPD, tambahkan opsi yang sesuai
                    var optionElement = document.createElement("option");
                    optionElement.value = "DPD";
                    optionElement.textContent = "DPD";
                    subPengusulDropdown.appendChild(optionElement);
                }
                // console.log("Nilai pengusul yang dipilih:", pengusulValue);

            });
        });
    </script>
@endsection
