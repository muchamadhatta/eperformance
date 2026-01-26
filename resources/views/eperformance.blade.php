<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">

    <title>ePerformance | DPR RI</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.css') }}">

    <!-- Text Editor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.bubble.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/jquery-timepicker/jquery.timepicker.min.css') }}">

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jqueryui/jquery-ui.min.js') }}"></script>

    <style>
        .card {

            transition: transform 0.3s ease;
            /* Efek transisi untuk memperbesar */
        }

        .card:hover {
            transform: scale(1.1);
            /* Memperbesar card saat hover */
        }
    </style>


</head>

<body>

    <div class="container mt-5">
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">

            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            {{-- <i class="ri-links-line"></i> --}}
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo.png') }}" alt="logo"
                                style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center text-dark">
                            <b class="text-uppercase">WEBSITE DPR RI</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://setjen.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">WEBSITE
                                SETJEN DPR RI</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">

                <a href="{{ asset('/setjen') }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            {{-- <i class="ri-links-line"></i> --}}
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center text-dark">
                            <b class="text-uppercase">ADMIN WEBSITE
                                SETJEN DPR RI</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ asset('/sileg') }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">SILEG</b>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://puuekkukesra.dpr.go.id" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Website
                                Pusat PUU Ekkuinbangkesra</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://pa3kn.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Website Pusat
                                Analisis Anggaran dan Akuntabilitas Keuangan Negara</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://pusaka.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Website
                                Pusat Analisis Keparlemenan</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://puspanlakuu.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center ">
                            <b class="text-uppercase text-dark">Website Pusat PANLAK UU</b>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!-- row -->
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://ittama.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center"><b class="text-uppercase text-dark">Website
                                Ittama</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://pusdiklat.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Website Pusdiklat</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://akd.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">SIAKD</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://bksap.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">BKSAP</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- row -->
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="https://puupolhukham.dpr.go.id/" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon primary">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Website Pusat PUU Polhukham</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">

            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">

            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">

            </div>
        </div>
        <!-- row -->


    </div>


    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/script.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/db.storage.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/chart.js/chart.min.js') }}"></script>


    <script src="{{ asset('theme/admin-dashbyte/dist/lib/prismjs/prism.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/colorpicker/spectrum.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</body>

</html>



{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Performance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <h1 class="text-center text-bg-success p-3">Cluster E-Performance</h1>
    <div class="container text-center">
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/sileg') }}" class="btn btn-success">SILEG</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/akd') }}" class="btn btn-success">AKD</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/pusaka') }}" class="btn btn-success">PUSAKA</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/puspanlakuu') }}" class="btn btn-success">PUSPANLAKUU</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/puuekkukesra') }}" class="btn btn-success">PUUEKKUKESRA</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/puupolhukham') }}" class="btn btn-success">PUUPOLHUKHAM</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/pa3kn') }}" class="btn btn-success">PA3KN</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/setjenadmin') }}" class="btn btn-success">SETJENADMIN</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/aladin') }}" class="btn btn-success">ALADIN</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/siterang') }}" class="btn btn-success">SITERANG</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/ittama') }}" class="btn btn-success">ITTAMA</a>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
                <a href="{{ asset('/pusdiklat') }}" class="btn btn-success">PUSDIKLAT</a>
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html> --}}
