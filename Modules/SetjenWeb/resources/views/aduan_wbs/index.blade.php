@extends('setjenweb::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Website</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Aduan WBS</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Aduan WBS</h4>
    </div>
    <div>
        <a href="{{ route('setjenweb.aduan_wbs.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Aduan WBS</a>
    </div>
</div><!-- row -->
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
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Nama</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Unit Kerja</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Topik</th>
                            <th scope="col" class="p-1 text-center" style="width: 15%;">Aduan</th>
                            <th scope="col" class="p-1 text-center" style="width: 10%;">Status Aduan</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aduan_wbss as $aduan_wbs)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $aduan_wbs->nama }}</td>
                                <td class="text-center">{{ $aduan_wbs->unit_kerja }}</td>
                                <td class="text-center">{{ $aduan_wbs->topik }}</td>
                                <td class="text-center">{{ $aduan_wbs->aduan }}</td>
                                <td class="text-center">{{ $aduan_wbs->status_aduan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.aduan_wbs.edit', $aduan_wbs->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.aduan_wbs.destroy', $aduan_wbs->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-line"></i>
                                            Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div><!-- table-responsive -->
        </div><!-- card-body -->

    </div>
@endsection
