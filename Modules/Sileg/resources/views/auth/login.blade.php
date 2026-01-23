<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <title>Login SILEG | DPR RI</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/animation/animation.css') }}">
</head>
<body class="page-sign d-block py-0">

    <div class="row g-0">
        <div class="col-md-7 col-lg-5 col-xl-4 col-wrapper animation-slide-left animation-duration-1">
            <div class="card card-sign">
                <div class="card-header">
                    <a href="{{ url('/') }}" class="header-logo mb-5" >SILEG</a>
                    {{-- saya ingin menambahkan gambar --}}

                    <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo.png') }}" alt="" width="120" style="margin-left: 20px;">
                    <h3 class="card-title">Masuk</h3>
                    <p class="card-text">Selamat Datang kembali! Silahkan masuk untuk melanjutkan.</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Masukkan Username Anda">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label d-flex justify-content-between">Sandi <a href="">Lupa Sandi?</a></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Sandi Anda">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sign">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col d-none d-lg-block animation-slide-right animation-duration-1"><img class="auth-img" alt="" src="{{ asset('theme/admin-dashbyte/dist/assets/img/bg-dpr.jpg') }}"> </div>
    </div>

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        'use script'

        var skinMode = localStorage.getItem('skin-mode');
        if(skinMode) {
            $('html').attr('data-skin', 'dark');
        }
    </script>
</body>
</html>

