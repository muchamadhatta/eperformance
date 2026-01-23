@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.polls.index') }}">Daftar Polls</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Polls</h4>
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

                <form action="{{ route('setjenweb.polls.update', $polls->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="vote_type" class="form-label fw-bold">Vote</label>
                            <select class="form-select w-50" name="vote_type" id="vote_type">
                                <option disabled selected>--Pilih--</option>
                                <option value="sangat bermanfaat" {{ $polls->vote_type == 'sangat bermanfaat' ? 'selected' : '' }}>Sangat Bermanfaat</option>
                                <option value="cukup bermanfaat" {{ $polls->vote_type == 'cukup bermanfaat' ? 'selected' : '' }}>Cukup Bermanfaat</option>
                                <option value="bermanfaat" {{ $polls->vote_type == 'bermanfaat' ? 'selected' : '' }}>Bermanfaat</option>
                                <option value="kurang bermanfaat" {{ $polls->vote_type == 'kurang bermanfaat' ? 'selected' : '' }}>Kurang Bermanfaat</option>
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="kritik_saran" class="form-label fw-bold">Kritik dan Saran</label>
                        <textarea class="form-control w-50" name="kritik_saran" id="kritik_saran" cols="30" rows="3">{{ $polls->kritik_saran }}</textarea>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#datepicker5').datepicker({
            showButtonPanel: true
        });

        $('#timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
@endsection
