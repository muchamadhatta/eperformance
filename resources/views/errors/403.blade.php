<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Akses Ditolak - ePerformance DPR RI">
    <meta name="author" content="DPR RI">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">

    <title>Akses Ditolak - ePerformance | DPR RI</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
</head>
<body class="page-error">

    <div class="header">
        <div class="container">
            <a href="{{ url('/') }}" class="sidebar-logo"> ePerformance
                <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo.png') }}" alt="DPR RI" style="height: 40px;">
            </a>
        </div><!-- container -->
    </div><!-- header -->

    <div class="content">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 d-flex flex-column align-items-center">
                    <h1 class="error-number">403</h1>
                    <h2 class="error-title">Akses Ditolak</h2>
                    <p class="error-text">Maaf, pengguna ini belum mempunyai hak akses pada Aplikasi ePerformance DPR-RI. Silakan hubungi administrator untuk mendapatkan akses.</p>
                    <div class="d-flex gap-2">
                        <a href="{{ url('https://portal.dpr.go.id') }}" class="btn btn-primary btn-error">Kembali ke Portal</a>
                        <button onclick="window.close()" class="btn btn-outline-secondary btn-error">Tutup Halaman</button>
                    </div>
                </div><!-- col -->
                <div class="col-8 col-lg-6 mb-5 mb-lg-0">
                    <object type="image/svg+xml" data="{{ asset('theme/admin-dashbyte/dist/assets/svg/security.svg') }}" class="w-100"></object>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- content -->

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        'use strict'

        var skinMode = localStorage.getItem('skin-mode');
        if(skinMode) {
            $('html').attr('data-skin', 'dark');
        }
    </script>
</body>
</html>