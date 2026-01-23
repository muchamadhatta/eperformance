<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <title>Login SINCAN | DPR RI</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/dist/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('template/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/lib/animation/animation.css') }}">
</head>
<body class="page-sign d-block py-0">

    <div class="row g-0">
        <div class="col-md-7 col-lg-5 col-xl-4 col-wrapper animation-slide-left animation-duration-1">
            <div class="card card-sign">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="header-logo mb-3">PUSTEKINFO</a>
                    <!-- Logo Instansi -->
                    <div class="my-3">
                        <img src="{{ asset('template/dist/assets/img/logo.png') }}" alt="Logo" width="120" style="margin-left: 20px;">
                    </div>
                    <h3 class="card-title mb-1">Masuk</h3>
                    <p class="card-text">Selamat Datang kembali! Silahkan masuk untuk melanjutkan.</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('magangpustekinfo.login') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email Anda">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-0" for="password">Sandi</label>
                                <a href="#" class="small">Lupa Sandi?</a>
                            </div>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Sandi Anda">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sign">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col d-none d-lg-block animation-slide-right animation-duration-1"><img class="auth-img" alt="" src="{{ asset('template/dist/assets/img/bg-dpr.jpg') }}"> </div>
    </div>

    <script src="{{ asset('template/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        'use script'

        var skinMode = localStorage.getItem('skin-mode');
        if(skinMode) {
            $('html').attr('data-skin', 'dark');
        }
    </script>
</body>
</html>


