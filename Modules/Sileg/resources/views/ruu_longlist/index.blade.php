@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Riwayat RUU Longlist</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Riwayat RUU Longlist</h4>
        </div>
        <div>
            <a href="{{ route('ruu_longlist.create') }}" class="btn btn-success">
                <i class="ri-pencil-line"></i> Tambah Riwayat RUU Longlist
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
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Periode Prolegnas</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Revisi</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Jumlah RUU</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prolegnas_revisis as $prolegnas_revisi)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">
                                    @if ($prolegnas_revisi->id_periode_prolegnas)
                                    @php
                                        $periode_prolegnas = App\Models\Sileg\Periode_prolegnas::find($prolegnas_revisi->id_periode_prolegnas)->periode_prolegnas;
                                    @endphp
                                    {{ $periode_prolegnas }}
                                @endif

                                </td>
                                <td class="text-center align-middle">{{ $prolegnas_revisi->revisi }}</td>
                                <td class="text-center align-middle">
                                    {{ App\Models\Sileg\Ruu_longlist::where('id_periode_prolegnas', $prolegnas_revisi->id_periode_prolegnas)->where('status', 1)->where('revisi', $prolegnas_revisi->revisi)->count() }}
                                    </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('ruu_longlist.edit', ['id_periode_prolegnas' => $prolegnas_revisi->id_periode_prolegnas, 'revisi' => $prolegnas_revisi->revisi]) }}"
                                        class="btn btn-primary">
                                        <i class="ri-edit-2-line"></i> Edit
                                    </a>

                                    <form action="{{ route('ruu_riwayat.destroy_longlist', ['id_periode_prolegnas' => $prolegnas_revisi->id_periode_prolegnas, 'revisi' => $prolegnas_revisi->revisi]) }}"
                                        method="POST" style="display: inline-block">
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
