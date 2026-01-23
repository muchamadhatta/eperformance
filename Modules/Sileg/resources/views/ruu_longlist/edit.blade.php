@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('ruu_longlist.index') }}">Daftar RUU Riwayat Longlist</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit RUU Riwayat Longlist</h4>
        </div>
    </div>

    <div class="card ">
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
                <form action="{{ route('ruu_longlist.update', $ruu_longlist->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="prolegnas" class="form-label fw-bold">Prolegnas</label>
                        <div class="d-flex flex-row gap-2">
                            <select disabled class="form-select w-50" name="id_periode_prolegnas" id="id_periode_prolegnas" required>
                                <option disabled selected>--Pilih Periode Prolegnas--</option>
                                @foreach ($prolegnass as $data)
                                    <option value="{{ $data->id }}" {{ $ruu_longlist->id_periode_prolegnas == $data->id ? 'selected' : '' }}>{{ $data->periode_prolegnas }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="revisi" class="form-label fw-bold">Revisi</label>
                        <div class="d-flex flex-row gap-2">
                            <input disabled required type="text" class="form-control w-50" id="revisi" name="revisi"
                                placeholder="Masukan Revisi" value="{{ $ruu_longlist->revisi }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    {{-- <input type="submit" value="Simpan Perubahan" class="btn btn-primary"> --}}
                </form>
            </div>
        </div>
    </div>


    <form
        action="{{ route('ruu.update_ruu_longlist', ['id_periode_prolegnas' => $ruu_longlist->id_periode_prolegnas, 'revisi' => $ruu_longlist->revisi]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mt-3 gap-2 d-flex justify-content-end">

            <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
            <a href="{{ route('ruu_longlist.create_ruu_longlist', ['id_periode_prolegnas' => $ruu_longlist->id_periode_prolegnas, 'revisi' => $ruu_longlist->revisi, 'id_periode_prolegnas' => $ruu_longlist->id_periode_prolegnas]) }}" class="btn btn-success">Tambah Data</a>
            <button type="button" class="btn btn-danger" id="hapusDataButton">Hapus Data</button>
            <a href="{{ route('ruu_longlist.index') }}" class="btn btn-secondary">Batal</a>
        </div>

        <div class="card mt-3">
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
                                <th scope="col" class="p-1 text-center" style="width: 5%;">
                                    <input type="checkbox" id="selectAllCheckbox">
                                <th scope="col" class="p-1 text-center" style="width: 50%;">Judul RUU Prioritas</th>
                                <th scope="col" class="p-1 text-center" style="width: 10%;">No Urut RUU Prioritas</th>
                                <th scope="col" class="p-1 text-center" style="width: 35%;">Pengusul Prioritas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($ruu_longlists as $ruu_longlist)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="id_ruu_longlist_hapus[{{ $ruu_longlist->id }}]"
                                            value="{{ $ruu_longlist->id }}"  id="id_ruu_longlist_hapus_{{ $ruu_longlist->id }}">
                                        <input type="hidden" name="id_ruu_longlist[{{ $ruu_longlist->id }}]"
                                            value="{{ $ruu_longlist->id }}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text"
                                            name="judul_ruu_longlist[{{ $ruu_longlist->id }}]"
                                            value="{{ $ruu_longlist->judul_ruu_longlist }}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text"
                                            name="no_urut_longlist[{{ $ruu_longlist->id }}]"
                                            value="{{ $ruu_longlist->no_urut_longlist }}">
                                    </td>
                                    <td>
                                        <select class="form-select" name="pengusul_longlist[{{ $ruu_longlist->id }}]"
                                            id="pengusul_longlist">
                                            <option disabled value="--Pilih Pengusul Prioritas--"></option>
                                            <option value="DPR"
                                                {{ $ruu_longlist->pengusul_longlist == 'DPR' ? 'selected' : '' }}>DPR
                                            </option>
                                            <option value="PEMERINTAH"
                                                {{ $ruu_longlist->pengusul_longlist == 'PEMERINTAH' ? 'selected' : '' }}>
                                                PEMERINTAH
                                            </option>
                                            <option value="DPD"
                                                {{ $ruu_longlist->pengusul_longlist == 'DPD' ? 'selected' : '' }}>DPD
                                            </option>
                                            <option value="DPR, PEMERINTAH"
                                                {{ $ruu_longlist->pengusul_longlist == 'DPR, PEMERINTAH' ? 'selected' : '' }}>
                                                DPR, PEMERINTAH
                                            </option>
                                            <option value="DPR, PEMERINTAH, DPD"
                                                {{ $ruu_longlist->pengusul_longlist == 'DPR, PEMERINTAH, DPD' ? 'selected' : '' }}>
                                                DPR, PEMERINTAH, DPD
                                            </option>
                                            <option value="DPR, DPD"
                                                {{ $ruu_longlist->pengusul_longlist == 'DPR, DPD' ? 'selected' : '' }}>
                                                DPR, DPD
                                            </option>

                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </form>

    <form id="hapusDataForm" action="{{ route('ruu_longlist.destroy_ruu_longlist', ['id_periode_prolegnas' => $ruu_longlist->id_periode_prolegnas, 'revisi' => $ruu_longlist->revisi]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <!-- Hidden Input Untuk ID yang Akan Dihapus -->
        <input type="hidden" name="hapus_ids[]" id="hapus_ids">
    </form>

    <script>
        document.getElementById('hapusDataButton').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data terpilih?')) {
                // Ambil semua ceklis yang dicentang
                var checkboxes = document.querySelectorAll('input[name^="id_ruu_longlist_hapus"]:checked');
                var ids = [];
                // Ambil ID dari setiap ceklis yang dicentang
                checkboxes.forEach(function(checkbox) {
                    ids.push(checkbox.value);
                    console.log(checkbox.value); // Tambahkan console.log di sini
                });
                // Set nilai input yang tersembunyi dengan ID yang akan dihapus
                document.getElementById('hapus_ids').value = ids;

                // Kirim formulir penghapusan
                document.getElementById('hapusDataForm').submit();
            }
        });
    </script>




@endsection
