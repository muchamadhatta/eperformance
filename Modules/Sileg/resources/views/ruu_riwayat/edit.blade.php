@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('ruu_riwayat.index') }}">Daftar Riwayat RUU</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Riwayat RUU</h4>
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
                <form action="{{ route('ruu_riwayat.update', $ruu_riwayat->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tahun" class="form-label fw-bold">Tahun</label>
                        <div class="d-flex flex-row gap-2">
                            <input disabled required type="text" class="form-control w-50" id="tahun" name="tahun"
                                placeholder="Masukan Tahun" value="{{ $ruu_riwayat->tahun }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="revisi" class="form-label fw-bold">Revisi</label>
                        <div class="d-flex flex-row gap-2">
                            <input disabled required type="text" class="form-control w-50" id="revisi" name="revisi"
                                placeholder="Masukan Revisi" value="{{ $ruu_riwayat->revisi }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    {{-- <input type="submit" value="Simpan Perubahan" class="btn btn-primary"> --}}
                </form>
            </div>
        </div>
    </div>


    <form
        action="{{ route('ruu.update_ruu_prioritas', ['tahun' => $ruu_riwayat->tahun, 'revisi' => $ruu_riwayat->revisi]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mt-3 gap-2 d-flex justify-content-end">

            <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
            <a href="{{ route('ruu_riwayat.create_ruu_prioritas', ['tahun' => $ruu_riwayat->tahun, 'revisi' => $ruu_riwayat->revisi, 'id_periode_prolegnas' => $ruu_riwayat->id_periode_prolegnas]) }}" class="btn btn-success">Tambah Data</a>
            <button type="button" class="btn btn-danger" id="hapusDataButton">Hapus Data</button>
            <a href="{{ route('ruu_riwayat.index') }}" class="btn btn-secondary">Batal</a>
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
                            @foreach ($ruu_prioritass as $ruu_prioritas)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="id_ruu_riwayat_hapus[{{ $ruu_prioritas->id }}]"
                                            value="{{ $ruu_prioritas->id }}"  id="id_ruu_riwayat_hapus_{{ $ruu_prioritas->id }}">
                                        <input type="hidden" name="id_ruu_riwayat[{{ $ruu_prioritas->id }}]"
                                            value="{{ $ruu_prioritas->id }}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text"
                                            name="judul_ruu_prioritas[{{ $ruu_prioritas->id }}]"
                                            value="{{ $ruu_prioritas->judul_ruu_prioritas }}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text"
                                            name="no_urut_prioritas[{{ $ruu_prioritas->id }}]"
                                            value="{{ $ruu_prioritas->no_urut_prioritas }}">
                                    </td>
                                    <td>
                                        <select class="form-select" name="pengusul_prioritas[{{ $ruu_prioritas->id }}]"
                                            id="pengusul_prioritas">
                                            <option disabled value="--Pilih Pengusul Prioritas--"></option>
                                            <option value="DPR"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'DPR' ? 'selected' : '' }}>DPR
                                            </option>
                                            <option value="PEMERINTAH"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'PEMERINTAH' ? 'selected' : '' }}>
                                                PEMERINTAH
                                            </option>
                                            <option value="DPD"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'DPD' ? 'selected' : '' }}>DPD
                                            </option>
                                            <option value="DPR, PEMERINTAH"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'DPR, PEMERINTAH' ? 'selected' : '' }}>
                                                DPR, PEMERINTAH
                                            </option>
                                            <option value="DPR, PEMERINTAH, DPD"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'DPR, PEMERINTAH, DPD' ? 'selected' : '' }}>
                                                DPR, PEMERINTAH, DPD
                                            </option>
                                            <option value="DPR, DPD"
                                                {{ $ruu_prioritas->pengusul_prioritas == 'DPR, DPD' ? 'selected' : '' }}>
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

    <form id="hapusDataForm" action="{{ route('ruu_riwayat.destroy_ruu_prioritas', ['tahun' => $ruu_riwayat->tahun, 'revisi' => $ruu_riwayat->revisi]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <!-- Hidden Input Untuk ID yang Akan Dihapus -->
        <input type="hidden" name="hapus_ids[]" id="hapus_ids">
    </form>

    <script>
        document.getElementById('hapusDataButton').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus data terpilih?')) {
                // Ambil semua ceklis yang dicentang
                var checkboxes = document.querySelectorAll('input[name^="id_ruu_riwayat_hapus"]:checked');
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
