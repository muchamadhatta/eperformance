@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.output.index') }}">Daftar Output</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Output</h4>
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

                <form action="{{ route('setjenweb.output.update', $output->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_website_menu" class="form-label fw-bold">Menu</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_website_menu" id="id_website_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($website_menus as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $output->id_website_menu ? 'selected' : '' }}>{{ $data->param }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Image</label>
                        @if ($output->image)
                            <br>
                            <img class="mb-3 border " src="{{ asset($output->image) }}" alt="Gambar" style="max-height: 100px;">
                            <br>
                            <a href="{{ route('setjenweb.output.deleteFile', ['id' => $output->id, 'jenis' => 'img']) }}" class="btn btn-danger"><i class="ri-delete-bin-line"></i> Hapus</a>
                        @else
                            <input type="file" class="form-control w-50" id="image" name="image" accept="image/*">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label fw-bold">Materi</label>

                        @if ($output->materi)
                            <br>
                            <a href="{{ asset($output->materi) }}" target="_blank"
                                class="btn btn-warning "><i class="ri-file-line"></i>
                                Tampilkan Materi</a>

                            <a href="#" class="btn btn-success">
                                <i class="ri-file-line"></i>
                                {{ ceil($output->file_size / 1024) }} KB
                            </a>

                            <a href="{{ route('setjenweb.output.deleteFile', ['id' => $output->id, 'jenis' => 'pdf']) }}"
                                class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                Hapus Materi</a>
                        @else
                            <input type="file" class="form-control w-50"
                                id="materi" name="materi" accept="application/pdf">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="rekaman" class="form-label fw-bold">Link Rekaman</label>
                        <textarea class="form-control w-50" name="rekaman" id="rekaman" cols="30" rows="3">{{ $output->rekaman }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" class="form-control w-50" id="judul" name="judul"
                            value="{{ $output->judul }}" placeholder="Masukan Judul">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="3">{{ $output->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input type="text" class="form-control w-50 datepicker5" id="tanggal" name="tanggal"
                            value="{{ date('m/d/Y', strtotime($output->tanggal)) }}" placeholder="Pilih Tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="tag" class="form-label fw-bold">Tag</label>
                        <input type="text" class="form-control w-50" id="tag" name="tag"
                            value="{{ $output->tag }}" placeholder="Masukan Tag">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                        <input type="text" class="form-control w-50" id="lokasi" name="lokasi"
                            value="{{ $output->lokasi }}" placeholder="Masukan Lokasi">
                    </div>

                    <div class="mb-3">
                        <label for="mulai" class="form-label fw-bold">Waktu Mulai</label>
                        <input  type="text" class="form-control w-15 timepicker" id="mulai" name="mulai"
                            value="{{ $output->mulai }}" placeholder="Pilih Waktu Mulai">
                    </div>
                    <div class="mb-3">
                        <label for="selesai" class="form-label fw-bold">Waktu Selesai</label>
                        <input  type="text" class="form-control w-15 timepicker" id="selesai" name="selesai"
                            value="{{ $output->selesai }}" placeholder="Pilih Waktu Selesai">
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.datepicker5').datepicker({
            showButtonPanel: true
        });

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
@endsection
