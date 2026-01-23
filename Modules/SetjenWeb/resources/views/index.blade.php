@extends('setjenweb::layouts.app')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item">Beranda</li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <h4 class="main-title mb-0">Selamat datang di Dashboard</h4>
        </div>

        <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <button type="button" class="btn btn-white btn-icon"><i class="ri-share-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-white btn-icon"><i class="ri-printer-line fs-18 lh-1"></i></button>

        </div>
    </div>

    <div class="row d-flex justify-content-evently">
        <div class="col-md-8 rounded">

            <div class="mb-5 border rounded p-1">
                <div class="row m-0">
                    <button type="button"
                        class="btn btn-success w-100 position-relative fw-bold text-dark text-start rounded p-1 mb-3"
                        data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false"
                        aria-controls="grafik1 grafik2">Statistik <i class="bi bi-caret-down-fill position-absolute"
                            style="right: 10px;"></i></button>
                    <div id="grafik1" class="collapse multi-collapse show">
                        <div id="chart1" class="col-md-12 mb-5 border rounded p-1" style="min-height: 365px;">
                            {{-- content graphic 1 --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="mb-5 border rounded p-1">
                <button type="button"
                    class="btn btn-success w-100 position-relative fw-bold text-dark text-start rounded p-1"
                    data-bs-toggle="collapse" data-bs-target="#bukuPanduan" aria-expanded="false"
                    aria-controls="bukuPanduan">Panduan <i class="bi bi-caret-down-fill position-absolute"
                        style="right: 10px;"></i></button>

                <div id="bukuPanduan" class="collapse show row m-0 justify-content-evenly">
                    <div class="col-md-6 mt-2 text-center">
                        <div class="p-3">


                            <a href="#" class="btn btn-warning " target="_blank"
                                class="d-flex flex-column align-items-center">
                                <img src="https://statik.dpr.go.id/images/admin/mantel/pdf_icon.png" width="50">
                                <br>
                                <span class="m-0 mt-2 text-center">Panduan Aplikasi Setjen Web - {{ $nama_website }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        let agendas = {!! json_encode($agendas) !!};
        let beritas = {!! json_encode($beritas) !!};
        let galeris = {!! json_encode($galeris) !!};
        let pegawais = {!! json_encode($pegawais) !!};
        let publikasis = {!! json_encode($publikasis) !!};


        // graphic 1
        var options1 = {
            series: [{
                data: [{
                        x: 'Agenda',
                        y: agendas.length,
                        fillColor: '#d0ae8b'
                    },
                    {
                        x: 'Berita',
                        y: beritas.length,
                        fillColor: '#e3c6ff'
                    },
                    {
                        x: 'Galeri',
                        y: galeris.length,
                        fillColor: '#87b8ea'
                    },
                    {
                        x: 'Pegawai',
                        y: pegawais.length,
                        fillColor: '#ae0e52'
                    },
                    {
                        x: 'Publikasi',
                        y: publikasis.length,
                        fillColor: '#c70d0f'
                    },
                    // {
                    //     x: 'Infografis',
                    //     y: infografiss.length,
                    //     fillColor: '#00fa9a'
                    // },
                    // {
                    //     x: 'Info Judicial Review',
                    //     y: infoJudicialReviews.length,
                    //     fillColor: '#006ab5'
                    // },
                    // {
                    //     x: 'Resume',
                    //     y: resumes.length,
                    //     fillColor: '#d0ff00'
                    // },
                    // {
                    //     x: 'Kompilasi UU Pasca Putusan MK',
                    //     y: kompilasis.length,
                    //     fillColor: '#d0ff00'
                    // },
                ],
            }],
            chart: {
                height: 350,
                // type: 'candlestick'
                // type: 'radar'
                // type: 'heatmap'
                // type: 'radialBar'
                // type: 'area'
                // type: 'line'
                type: 'bar'


            },
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            dataLabels: {
                enabled: true
            },
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();
    </script>
@endpush
