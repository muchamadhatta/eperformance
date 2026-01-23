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

    <title>SETJEN WEB | DPR RI</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.css') }}">

    <!-- Text Editor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.bubble.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin-dashbyte/dist/lib/jquery-timepicker/jquery.timepicker.min.css') }}">

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


    <style>
        /* Style for the scroll button */
        #scrollBtn {
            display: none;
            position: fixed;
            bottom: 45px;
            right: 0px;
            z-index: 99;
            font-size: 30px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            padding: 0px;
            border-radius: 50%;
        }
    </style>


</head>

<body>

    <div class="container mt-5">
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 1]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            {{-- <i class="ri-links-line"></i> --}}
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Sekretariat
                                Jendral DPR RI</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 5]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            {{-- <i class="ri-links-line"></i> --}}
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Deputi
                                Persidangan</b>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 23]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Persidangan 1</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 24]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Persidangan 2</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 18]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Kesekretariatan
                                Pimpinan</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 17]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro Kerja
                                Sama Antar Parlemen Dan
                                Organisasi Internasional</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 21]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Pemberitaaan Parlemen</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 25]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Protokol Dan
                                Hubungan Masyarakat</b>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!-- row -->
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 4]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Deputi
                                Administrasi</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 16]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Hukum Dan Pengaduan
                                Masyarakat</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 26]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Sumber Daya Manusia
                                Aparatur</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 20]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Organisasi Dan
                                Perencanaan</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- row -->
        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 19]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Keuangan</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 22]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Pengelolaan Bangunan Dan
                                Wisma</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 27]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Biro
                                Umum</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 6]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Reformasi
                                Birokrasi</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- row -->

        <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 3]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Inspektorat Utama</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 13]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Pusat
                                Pendidikan Dan
                                Pelatihan</b>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 15]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-korpri.png') }}"
                                alt="logo" style="max-height: 80px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Korps
                                Pegawai Republik
                                Indonesia Sekretariat Jenderal DPR RI</b>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <a href="{{ route('set.session', ['id_website' => 14]) }}" class="text-decoration-none">
                    <div class="card card-file ">
                        <div class="card-file-icon success">
                            <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-pustekinfo.png') }}"
                                alt="logo" style="max-height: 40px;">
                        </div>
                        <div class="card-body text-center">
                            <b class="text-uppercase text-dark">Pusat
                                Teknologi
                                Informasi</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- row -->

        {{-- <!-- row -->
        <div class="row g-1 g-sm-2 g-xl-3 mb-5 ">
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <div class="card card-file ">
                    <div class="card-file-icon info">
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                            alt="logo" style="max-height: 80px;">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('set.session', ['id_website' => 9]) }}" class="btn btn-light"><del><b>Pusat Analisis Anggaran dan
                                Akuntabilitas Keuangan Negara</b></del></a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <div class="card card-file ">
                    <div class="card-file-icon info">
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                            alt="logo" style="max-height: 80px;">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('set.session', ['id_website' => 10]) }}" class="btn btn-light"><del><b>Pusat Perancangan
                                Undang-Undang Bidang Politik, Hukum, dan Hak Asasi Manusia</b></del></a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <div class="card card-file ">
                    <div class="card-file-icon info">
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                            alt="logo" style="max-height: 80px;">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('set.session', ['id_website' => 10]) }}" class="btn btn-light"><del><b>Pusat Perancangan
                                Undang-Undang Bidang Ekonomi, Keuangan, Industri, Pembangunan, dan Kesejahteraan
                                Rakyat</b></del></a>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-xl ">
                <div class="card card-file ">
                    <div class="card-file-icon info">
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                            alt="logo" style="max-height: 80px;">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('set.session', ['id_website' => 11]) }}" class="btn btn-light"><del><b>Pusat Pemantauan Pelaksanaan
                                Undang-Undang</b></del></a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- row -->

        {{-- <div class="col-3 col-sm-4 col-md-3 col-xl ">
            <div class="card card-file ">
                <div class="card-file-icon success">
                    <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                        alt="logo" style="max-height: 80px;">
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('set.session', ['id_website' => 2]) }}" class="btn btn-light"><del><b>Badan Keahlian DPR RI</b></del></a>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-3 col-sm-4 col-md-3 col-xl ">
            <div class="card card-file ">
                <div class="card-file-icon info">
                    <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo-setjen-dpr.png') }}"
                        alt="logo" style="max-height: 80px;">
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('set.session', ['id_website' => 8]) }}" class="btn btn-light"><del><b>Pusat Analis Keparlemenan</b></del></a>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- Scroll button -->
    <a href="{{ asset('/') }}">
        <div class="card" id="scrollBtn">
            <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" fill="rgba(82,227,164,1)">
                <path
                    d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z">
                </path>
            </svg>
        </div>
    </a>

    <script>
        // Function to check if the page is scrolled to the bottom
        function isBottom() {
            return (window.innerHeight + window.scrollY) >= document.body.offsetHeight;
        }

        // Function to show or hide the scroll button based on scroll position
        function toggleScrollButton() {
            var scrollBtn = document.getElementById("scrollBtn");
            if (isBottom()) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        }

        // Function to scroll to the top of the page
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Event listener for scroll event
        window.addEventListener("scroll", function() {
            toggleScrollButton();
        });
    </script>

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
