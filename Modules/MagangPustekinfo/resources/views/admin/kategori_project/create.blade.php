@extends('magangpustekinfo::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('magangpustekinfo.admin.kategori_project.index') }}">Daftar Kategori Project</a>
                </li>
            </ol>
            <h4 class="main-title mb-0">Tambah Kategori Project</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('magangpustekinfo.admin.kategori_project.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Kategori</label>
                        <div class="d-flex flex-row gap-2">
                            <input required type="text" class="form-control w-100" id="name" name="name"
                                placeholder="Masukan Nama Kategori" value="{{ old('name') }}">
                            <font style="color: red; display: flex; align-items: center; padding: 0;">*</font>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Deskripsi singkat (opsional)" value="{{ old('description') }}">
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label fw-bold">Icon (Remixicon Class)</label>
                        <input type="text" class="form-control" id="icon" name="icon"
                            placeholder="Contoh: ri-code-line (opsional)" value="{{ old('icon') }}">
                        <small class="text-muted">Cari icon di <a href="https://remixicon.com/" target="_blank">Remixicon</a></small>
                    </div>

                    <!-- Hidden default values -->
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="sort_order" value="0">

                    <input type="submit" value="Simpan" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection


