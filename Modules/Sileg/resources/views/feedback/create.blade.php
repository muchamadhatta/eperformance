@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('feedback.index') }}">Daftar Feedback</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Feedback</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('feedback.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="judul_ruu" class="form-label fw-bold">Judul RUU</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_ruu" id="id_ruu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($ruus as $data)
                                    <option value="{{ $data->id }}">{{ $data->judul_ruu }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control w-50 " id="nama" name="nama"
                                value="" placeholder="Masukan Nama" required>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="email" class="form-control w-50" id="email" name="email"
                                value="" placeholder="Masukan Email" required>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label fw-bold">Pesan</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="pesan" id="pesan" cols="30" rows="5"></textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status_publikasi" class="form-label fw-bold">Status Publikasi</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="radio" name="status_publikasi" id="status_publikasi" value="0"
                               > <label
                                for="status_publikasi">Draft</label>
                            <input type="radio" name="status_publikasi" id="status_publikasi" value="1"
                                > <label
                                for="status_publikasi">Published</label>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_akd1" class="form-label fw-bold">Bidang Penugasan 1</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_akd1" id="id_akd1">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($akds as $data)
                                    <option value="{{ $data->id }}">{{ $data->akd }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="balasan1" class="form-label fw-bold">Balasan 1</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="balasan1" id="balasan1" cols="30" rows="5"></textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_akd2" class="form-label fw-bold">Bidang Penugasan 2</label>
                        <div class="d-flex flex-row gap-2">

                            <select class="form-select w-50" name="id_akd2" id="id_akd2">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($akds as $data)
                                    <option value="{{ $data->id }}">{{ $data->akd }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="balasan2" class="form-label fw-bold">Balasan 2</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="balasan2" id="balasan2" cols="30" rows="5"></textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_akd3" class="form-label fw-bold">Bidang Penugasan 3</label>
                        <div class="d-flex flex-row gap-3">
                            <select class="form-select w-50" name="id_akd3" id="id_akd3">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($akds as $data)
                                    <option value="{{ $data->id }}">{{ $data->akd }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="balasan3" class="form-label fw-bold">Balasan 3</label>
                        <div class="d-flex flex-row gap-3">
                            <textarea class="form-control w-50" name="balasan3" id="balasan3" cols="30" rows="5"></textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker5').datepicker({
                showButtonPanel: true
            });
        });
    </script>
@endsection
