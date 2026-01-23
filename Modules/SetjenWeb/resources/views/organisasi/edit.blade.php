@extends('setjenweb::layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Pengaturan</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.organisasi.index') }}">Struktur Organisasi</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Struktur Organisasi</h4>
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

                <form action="{{ route('setjenweb.organisasi.update', $organisasi->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="Posisi" class="form-label fw-bold">Posisi</label>
                        <input type="text" class="form-control w-50" id="posisi" name="posisi"
                            value="{{ $organisasi->posisi }}" placeholder="Masukan Posisi">
                    </div>
                    <div class="mb-3">
                        <label for="id_user" class="form-label fw-bold mb">Pegawai</label>
                        <br>
                        <select class="form-select select2 w-50 " name="id_user" id="id_user">
                            <option disabled selected>--Pilih--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $id_user ? 'selected' : '' }}>
                                    {{ $user->nama }}</option>
                            @endforeach
                        </select>
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
            <a href="{{ route('setjenweb.organisasi.index') }}" class="btn btn-secondary">Kembali</a>

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
                    <form action="{{ route('setjenweb.organisasi.store_organisasi_data') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control w-50" id="parent" name="parent"
                            value="{{ $organisasi->id }}">
                        <input type="hidden" class="form-control w-50" id="id_website" name="id_website"
                            value="{{ $organisasi->id_website }}">

                        <div class="mb-3">
                            <label for="posisi" class="form-label fw-bold">Posisi</label>
                            <font color="red">*</font>
                            <input type="text" class="form-control w-50" id="posisi" name="posisi"
                                placeholder="Masukan Posisi" value="">
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
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Posisi</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Pegawai</th>
                                <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                @if ($organisasi->id == $data->parent)
                                    <tr>
                                        <td class="text-center">{{ $nomor++ }}</td>
                                        <td class="text-center">{{ $data->posisi }}</td>
                                        <td class="text-center">
                                            @php
                                                $user = App\Models\Setjen\StrukturOrganisasiUser::where(
                                                    'id_struktur_organisasi',
                                                    $data->id,
                                                )->first();
                                            @endphp
                                            @if ($user)
                                                @php
                                                    $nama_user = App\Models\Setjen\User::find($user->id_user);
                                                @endphp
                                                @if ($nama_user)
                                                    {{ $nama_user->nama }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('setjenweb.organisasi.edit', $data->id) }}"
                                                class="btn btn-primary"><i class="ri-edit-2-line"></i> Edit</a>

                                            <a href="{{ route('setjenweb.organisasi.destroy_organisasi_data', $data->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();"
                                                class="btn btn-danger">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </a>

                                            <form id="delete-form-{{ $data->id }}"
                                                action="{{ route('setjenweb.organisasi.destroy_organisasi_data', $data->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
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

        // With search
        $('.select2').select2({
            placeholder: 'Cari..',
            allowClear: true
        });
    </script>

    <script></script>
@endsection
