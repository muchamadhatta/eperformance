@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('kumulatif.index') }}">Daftar Kumulatif</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Kumulatif</h4>
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
                <form action="{{ route('kumulatif.update', $kumulatif->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kumulatif" class="form-label fw-bold">Kumulatif</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="kumulatif" name="kumulatif"
                                placeholder="Masukan Kumulatif" value="{{ $kumulatif->kumulatif }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
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

            <div class="table-responsive">
                <table id="tableGrid3">
                    <thead>
                        <tr>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">No</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Judul RUU</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Pengusul</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Tanggal Pengusulan</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Tahapan</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Penjelasan</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruus as $ruu)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $ruu->judul_ruu }}</td>
                                <td>{{ $ruu->pengusul }}</td>
                                <td>{{ $ruu->tanggal_pengusulan }}</td>
                                <td>
                                    @if ($ruu->id_pembahasan_ruu)
                                        @php
                                            $tahapan = App\Models\Sileg\Pembahasan_ruu::find($ruu->id_pembahasan_ruu)->tahapan;
                                        @endphp
                                        {{ $tahapan }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ruu->id_pembahasan_ruu)
                                        @php
                                            $penjelasan = App\Models\Sileg\Pembahasan_ruu::find($ruu->id_pembahasan_ruu)->penjelasan;
                                        @endphp
                                        {{ $penjelasan }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('ruu.edit', $ruu->id) }}"
                                        class="btn btn-primary ">
                                        <i class="ri-edit-2-line"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

