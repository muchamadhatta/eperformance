@extends('setjenweb::layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 ">
    <div>
        <ol class="breadcrumb fs-sm mb-1 ">
            <li class="breadcrumb-item">Data Website</li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Billboard</li>
        </ol>
        <h4 class="main-title mb-0">Daftar Billboard</h4>
    </div>
    <div>
        <a href="{{ route('setjenweb.billboard.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Billboard</a>
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
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Gambar</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billboards as $billboard)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    @if ($billboard->image_name)
                                        <img src="{{ asset($billboard->image_name) }}" alt="Album"
                                            style="max-width: 100px; max-height: 100px;">
                                    @endif
                                </td>
                                <td class="text-center">{{ $billboard->judul }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.billboard.edit', $billboard->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.billboard.destroy', $billboard->id) }}" method="POST"
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
