@extends('sileg::layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item"><a href="{{ route('ruu_longlist.index') }}">Daftar RUU Riwayat Longlist</a></li>
            </ol>
            <h4 class="main-title mb-0">Tambah RUU Riwayat Longlist</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <form action="{{ route('ruu_longlist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="prolegnas" class="form-label fw-bold">Prolegnas</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="id_periode_prolegnas" id="id_periode_prolegnas" required>
                                <option disabled selected>--Pilih Periode Prolegnas--</option>
                                @foreach ($prolegnass as $data)
                                    <option value="{{ $data->id }}">{{ $data->periode_prolegnas }}</option>
                                @endforeach
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="revisi" class="form-label fw-bold">Revisi</label>
                        <div class="d-flex flex-row gap-2">
                            <select class="form-select w-50" name="revisi" id="revisi" required>
                                <option disabled selected>--Pilih Data--</option>
                                @for ($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <font style="color: red; display: flex; align-items: flex-end; padding: 0;">*</font>
                        </div>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary">


                    <div class="table-responsive mt-3">
                        <table id="tableGrid3">
                            <thead>
                                <tr>
                                    <th scope="col" class="p-1 text-center" style="width: 5%;">
                                        <input type="checkbox" id="selectAllCheckbox">
                                    <th scope="col" class="p-1 text-center" style="width: 85%;">Judul RUU</th>
                                    <th scope="col" class="p-1 text-center" style="width: 10%;">No Urut Priotitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruus as $index => $ruu)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="id_ruu[{{ $index }}]"
                                                value="{{ $ruu->id }}">
                                        </td>
                                        <td>{{ $ruu->judul_ruu }}</td>
                                        <td>
                                            <input disabled type="text" name="no_urut_longlist[{{ $index }}]"
                                                value="0" class="form-control" required>
                                            <input disabled type="hidden" name="judul_ruu_longlist[{{ $index }}]"
                                                value="{{ $ruu->judul_ruu }}">
                                            <input disabled type="hidden" name="pengusul_longlist[{{ $index }}]"
                                                value="{{ $ruu->pengusul }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="id_ruu"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const index = this.getAttribute('name').match(/\[(.*?)\]/)[1];
                    const inputs = document.querySelectorAll('input[name^="no_urut_longlist[' + index + ']"], input[name^="judul_ruu_longlist[' + index + ']"], input[name^="pengusul_longlist[' + index + ']"]');

                    inputs.forEach(function(input) {
                        input.disabled = !checkbox.checked;
                        if (!checkbox.checked) {
                            input.value = ""; // Reset nilai input jika checkbox tidak dicentang
                        }
                    });
                });
            });
        });
    </script>

@endsection
