@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar RUU</li>
            </ol>
            <h4 class="main-title mb-0">Daftar RUU</h4>
        </div>
        <div>
            <a href="{{ route('ruu.create') }}" class="btn btn-success">
                <i class="ri-pencil-line"></i> Tambah RUU
            </a>
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
                                    <a href="{{ route('ruu.edit', $ruu->id) }}" class="btn btn-primary ">
                                        <i class="ri-edit-2-line"></i> Edit
                                    </a>
                                    <form action="{{ route('ruu.destroy', $ruu->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">
                                            <i class="ri-delete-bin-line"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
