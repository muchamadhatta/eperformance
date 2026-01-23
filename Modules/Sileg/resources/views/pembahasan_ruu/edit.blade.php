@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('pembahasan_ruu.index') }}">Daftar Pembahasan RUU</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Pembahasan RUU</h4>
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
                <form action="{{ route('pembahasan_ruu.update', $pembahasan_ruu->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tahapan" class="form-label fw-bold">Tahapan</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="tahapan" name="tahapan"
                                placeholder="Masukan Tahapan" value="{{ $pembahasan_ruu->tahapan }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="penjelasan" class="form-label fw-bold">Penjelasan</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-50" id="penjelasan" name="penjelasan"
                                placeholder="Masukan Penjelasan" value="{{ $pembahasan_ruu->penjelasan }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
