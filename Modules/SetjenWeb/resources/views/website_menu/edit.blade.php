@extends('setjenweb::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Website</li>
                <li class="breadcrumb-item"><a href="{{ route('setjenweb.website_menu.index') }}">Daftar Menu Website</a></li>
            </ol>
            <h4 class="main-title mb-0">Edit Menu Website</h4>
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
                <form action="{{ route('setjenweb.website_menu.update', $website_menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_menu" class="form-label fw-bold">Judul Menu</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_menu" id="id_menu">
                                <option disabled selected>--Pilih--</option>
                                @foreach ($menus as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $website_menu->id_menu ? 'selected' : '' }}>{{ $data->judul }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="param" class="form-label fw-bold">Link</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control w-50" id="param" name="param"
                                placeholder="Masukan Warna" value="{{ $website_menu->param }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ $website_menu->deskripsi }}</textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label fw-bold">Icon/SVG</label>
                        <div class="d-flex flex-row gap-2">
                            <textarea class="form-control w-50" name="icon" id="icon" cols="30" rows="10">{{ $website_menu->icon }}</textarea>
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="icon_color" class="form-label fw-bold">Icon Color</label>
                        <div class="d-flex flex-row gap-2">
                            <input type="text" class="form-control w-50" id="icon_color" name="icon_color"
                                placeholder="Masukan Warna" value="{{ $website_menu->icon_color }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                    </div>

                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
