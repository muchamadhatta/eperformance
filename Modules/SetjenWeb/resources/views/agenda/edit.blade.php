@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                {{-- <li class="breadcrumb-item"><a href="#">Menu</a></li> --}}
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.agenda.index') }}">Agenda</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Agenda</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">

                <form action="{{ route('setjenweb.agenda.update', $agenda->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $agenda->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3">{{ $agenda->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input id="datepicker5" type="text" class="form-control w-15 " id="tanggal" name="tanggal"
                            value="{{ date('m/d/Y', strtotime($agenda->tanggal)) }}" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="waktu" class="form-label fw-bold">Waktu</label>
                        <input id="timepicker" type="text" class="form-control w-15 " id="jam" name="jam"
                            value="{{ $agenda->jam }}" placeholder="Pilih Waktu">
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label fw-bold">Tempat</label>
                        <input type="text" class="form-control w-50" id="tempat" name="tempat"
                            value="{{ $agenda->tempat }}" placeholder="Masukan Tempat">
                    </div>
                    <div class="mb-3">
                        <label for="id_tujuan_agenda" class="form-label fw-bold">Tujuan Agenda</label>
                        <select class="form-select w-50" name="id_tujuan_agenda" id="id_tujuan_agenda">
                            <option disabled selected>--Pilih--</option>
                            @foreach ($tujuan_agendas as $data)
                                <option value="{{ $data->id }}" {{ $data->id == $agenda->id_tujuan_agenda ? 'selected' : '' }}>{{ $data->tujuan_agenda }}</option>
                            @endforeach
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
