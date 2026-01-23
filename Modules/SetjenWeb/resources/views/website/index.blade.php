@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Pengaturan</li>
                <li class="breadcrumb-item active" aria-current="page">Website</li>
            </ol>
            <h4 class="main-title mb-0">Website</h4>
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
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Nama Website</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Nama Website</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($websites as $website)
                            <tr>
                                <td class="p-1 text-center">{{ $website->nama_website }}</td>
                                <td class="p-1 text-center">{{ $website->url }}</td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.website.edit', $website->id) }}"
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
