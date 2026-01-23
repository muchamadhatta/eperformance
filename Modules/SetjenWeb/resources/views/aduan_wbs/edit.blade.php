@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.aduan_wbs.index') }}">Daftar Aduan WBS</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Aduan WBS</h4>
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

                <form action="{{ route('setjenweb.aduan_wbs.update', $aduan_wbs->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="dokumen" class="form-label fw-bold">Dokumen</label>
                        @if ($aduan_wbs->dokumen)
                            <br>
                            <img class="mb-3 border " src="{{ asset($aduan_wbs->dokumen) }}" alt="Gambar"
                                style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.aduan_wbs.deleteFile', ['id' => $aduan_wbs->id, 'jenis' => 'img']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="dokumen" name="dokumen" accept="image/*">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" name="nama"
                            value="{{ $aduan_wbs->nama }}" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="unit_kerja" class="form-label fw-bold">Unit Kerja</label>
                        <input type="text" class="form-control w-50" id="unit_kerja" name="unit_kerja"
                            value="{{ $aduan_wbs->unit_kerja }}" placeholder="Masukan Unit Kerja">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-15 " id="tanggal" name="tanggal"
                            value="{{ date('m/d/Y', strtotime($aduan_wbs->tanggal)) }}" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="topik" class="form-label fw-bold">Topik</label>
                        <textarea class="form-control w-50" name="topik" id="topik" cols="30" rows="3">{{ $aduan_wbs->topik }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aduan" class="form-label fw-bold">Aduan</label>
                        <textarea class="form-control w-50" name="aduan" id="aduan" cols="30" rows="3">{{ $aduan_wbs->aduan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kodeunik" class="form-label fw-bold">Kode Unik</label>
                        <input type="text" class="form-control w-50" id="kodeunik" name="kodeunik"
                            value="{{ $aduan_wbs->kodeunik }}" placeholder="Masukan Kode Unik">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="balasan" class="form-label fw-bold">Balasan</label>
                        <textarea class="form-control w-50" name="balasan" id="balasan" cols="30" rows="3">{{ $aduan_wbs->balasan }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kodeunik" class="form-label fw-bold">Status Aduan</label>
                        <select name="status_aduan" class="form-control w-50" id="status_aduan">
                            <option value="Dalam Proses"
                                {{ $aduan_wbs->status_aduan == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="Selesai" {{ $aduan_wbs->status_aduan == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
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
