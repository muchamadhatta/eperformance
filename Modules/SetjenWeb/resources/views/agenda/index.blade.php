@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
        <div>
            <ol class="breadcrumb fs-sm mb-1 ">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Agenda</li>
            </ol>
            <h4 class="main-title mb-0">Daftar Agenda</h4>
        </div>
        <div>
            <a href="{{ route('setjenweb.agenda.create') }}" class="btn btn-success"><i class="ri-pencil-line"></i> Tambah Agenda</a>
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
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Judul</th>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">Tanggal</th>
                            <th scope="col" class="p-1 text-center" style="width: 5%;">Jam</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Tujuan</th>
                            <th scope="col" class="p-1 text-center" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas as $agenda)
                            <tr>

                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $agenda->judul }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($agenda->tanggal)) }}</td>
                                <td class="text-center">{{ $agenda->jam }}</td>
                                <td class="text-center">
                                    @if ($agenda->id_tujuan_agenda)
                                        @php
                                            $tujuan_agenda = App\Models\Setjen\TujuanAgenda::find($agenda->id_tujuan_agenda)->tujuan_agenda;
                                        @endphp
                                        {{ $tujuan_agenda }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('setjenweb.agenda.edit', $agenda->id) }}" class="btn btn-primary"><i
                                            class="ri-edit-2-line"></i> Edit</a>
                                    <form action="{{ route('setjenweb.agenda.destroy', $agenda->id) }}" method="POST"
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
