@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Feedback</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Feedback</h4>

        </div>


    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">

        <div class="d-flex align-items-end">
            <h6 class="me-3 ">Periode:</h6>
            <form action="{{ route('feedback.index') }}" method="GET" class="d-flex">
                <select class="form-select me-2" name="periode" id="periode">
                    <option disabled>--Pilih Data--</option>
                    <option value="seluruh" {{ session('periode') == 'seluruh' ? 'selected' : '' }}>Seluruh</option>
                    @php
                        $currentYear = date('Y');
                    @endphp

                    @for ($year = $currentYear; $year >= 2009; $year--)
                        <option value="{{ $year }}" {{ session('periode') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor

                </select>
                <button class="btn btn-primary" type="submit">Set</button>
            </form>
        </div>

        {{-- <div>
            <a href="{{ route('feedback.create') }}" class="btn btn-success">
                <i class="ri-pencil-line"></i> Tambah Feedback
            </a>
        </div> --}}

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
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Judul RUU</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Pengirim</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Pesan</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Status Publikasi</th>
                            <th scope="col" class="p-1 text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="text-center align-middle">
                                    @if ($feedback->id_ruu)
                                        @php
                                            $ruu = App\Models\Sileg\Ruu::find($feedback->id_ruu)->judul_ruu;
                                        @endphp
                                        {{ $ruu }}
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <p>{{ $feedback->nama }}</p>
                                    <hr>
                                    <p>{{ $feedback->email }}</p>
                                    <hr>
                                    <p>{{ $feedback->tanggal_input }}</p>
                                    <hr>
                                </td>
                                <td class="text-center align-middle">{{ $feedback->pesan }}</td>
                                <td class="text-center align-middle">{{ $feedback->status_publikasi == 0 ? 'Draft' : 'Published' }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-primary ">
                                        <i class="ri-edit-2-line"></i> Edit
                                    </a>
                                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST"
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
