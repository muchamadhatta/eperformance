@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('ruu.index') }}">Daftar RUU</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah RUU</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('ruu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="judul_ruu" class="form-label fw-bold">Judul RUU</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="judul_ruu" name="judul_ruu"
                                placeholder="Masukan Judul RUU" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pengusul" class="form-label fw-bold">Pengusul</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="DPR" id="flexCheckDPR"
                                name="pengusul[]">
                            <label class="form-check-label" for="flexCheckDPR">
                                DPR
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="Pemerintah" id="flexCheckPemerintah"
                                name="pengusul[]">
                            <label class="form-check-label" for="flexCheckPemerintah">
                                Pemerintah
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="DPD" id="flexCheckDPD"
                                name="pengusul[]">
                            <label class="form-check-label" for="flexCheckDPD">
                                DPD
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pengusul_prioritas" class="form-label fw-bold">Pengusul Prioritas</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" id="pengusul_prioritas" name="pengusul_prioritas">
                                <option disabled selected>--Pilih Pengusul Prioritas--</option>
                                <option value="DPR">DPR</option>
                                <option value="Pemerintah">Pemerintah</option>
                                <option value="DPD">DPD</option>
                            </select>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengusulan" class="form-label fw-bold">Tanggal Pengusulan</label>
                        <input id="datepicker5" type="text" class="form-control w-15 bg-secondary text-white "
                            id="tanggal_pengusulan" name="tanggal_pengusulan" value=""
                            placeholder="Pilih Tanggal Pengusulan">
                    </div>

                    <div class="mb-3">
                        <label for="id_pembahasan_ruu" class="form-label fw-bold">Pembahasan RUU</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_pembahasan_ruu" id="id_pembahasan_ruu">
                                <option disabled selected>--Pilih Data--</option>
                                @foreach ($pembahasan_ruu as $data)
                                    <option value="{{ $data->id }}">{{ $data->tahapan }} - {{ $data->penjelasan }}
                                    </option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_akd" class="form-label fw-bold">Lingkup Bidang Tugas</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-15" name="id_akd" id="id_akd">
                                <option disabled selected>--Pilih Data--</option>
                                <option value="1">Komisi I</option>
                                <option value="2">Komisi II</option>
                                <option value="3">Komisi III</option>
                                <option value="4">Komisi IV</option>
                                <option value="5">Komisi V</option>
                                <option value="6">Komisi VI</option>
                                <option value="7">Komisi VII</option>
                                <option value="8">Komisi VIII</option>
                                <option value="9">Komisi IX</option>
                                <option value="10">Komisi X</option>
                                <option value="11">Komisi XI</option>
                                <option value="14">Badan Legislasi</option>
                                <option value="15">Badan Anggaran</option>
                                <option value="20">Panitia Khusus</option>
                            </select>
                            <font style=" display: flex; align-items: center; padding: 0;">set_pansus@dpr.go.id</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_urut_longlist" class="form-label fw-bold">No Urut Longlist</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="number" class="form-control w-50" id="no_urut_longlist"
                                name="no_urut_longlist" placeholder="Masukan No Urut Longlist" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="keterangan" name="keterangan"
                                placeholder="Masukan Keterangan" value="">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#datepicker5').datepicker({
            showButtonPanel: true
        });
    </script>
@endsection
