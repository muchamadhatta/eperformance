@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.aduan_wbs.index') }}">Daftar Aduan WBS</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah Aduan WBS</h4>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.aduan_wbs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="dokumen" class="form-label fw-bold">Dokumen</label>
                        <input type="file" class="form-control w-50" id="dokumen" name="dokumen" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama" value=""
                            placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="unit_kerja" class="form-label fw-bold">Unit Kerja</label>
                        <input type="text" class="form-control w-50" id="unit_kerja" name="unit_kerja" value=""
                            placeholder="Masukan Unit Kerja">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-15 " id="tanggal" name="tanggal"
                            value="" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="topik" class="form-label fw-bold">Topik</label>
                        <textarea class="form-control w-50" name="topik" id="topik" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aduan" class="form-label fw-bold">Aduan</label>
                        <textarea class="form-control w-50" name="aduan" id="aduan" cols="30" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kodeunik" class="form-label fw-bold">Kode Unik</label>
                        <input type="text" class="form-control w-50" id="kodeunik" name="kodeunik" value=""
                            placeholder="Masukan Kode Unik">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="balasan" class="form-label fw-bold">Balasan</label>
                        <textarea class="form-control w-50" name="balasan" id="balasan" cols="30" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kodeunik" class="form-label fw-bold">Status Aduan</label>
                        <select name="status_aduan" class="form-control w-50" id="status_aduan">
                            <option selected value="Dalam Proses">Dalam Proses</option>
                            <option value="Selesai">Selesai
                            </option>
                        </select>
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

        $('#timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
@endsection
