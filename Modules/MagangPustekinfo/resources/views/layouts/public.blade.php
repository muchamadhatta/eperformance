<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Data Peserta Magang - PUSTEKINFO DPR RI">
    <meta name="author" content="PUSTEKINFO DPR RI">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Input Data Magang') | PUSTEKINFO DPR RI</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --color-primary: #6B1C2A;
            --color-primary-dark: #4A1320;
            --color-primary-light: #8B2C3A;
            --color-gold: #D4AF37;
            --color-gold-light: #E5C76B;
            --color-dark: #1a1a2e;
            --color-light: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            --gradient-gold: linear-gradient(135deg, var(--color-gold) 0%, var(--color-gold-light) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        .header-public {
            background: var(--gradient-primary);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(107, 28, 42, 0.3);
            position: relative;
            z-index: 100;
        }

        .header-public::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: white;
        }

        .header-brand img {
            height: 50px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .header-brand-text {
            display: flex;
            flex-direction: column;
        }

        .header-brand-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-gold);
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .header-brand-subtitle {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.9);
            font-weight: 400;
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0 3rem;
            min-height: calc(100vh - 180px);
        }

        /* Footer */
        .footer-public {
            background: var(--color-dark);
            color: rgba(255,255,255,0.7);
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.85rem;
        }

        .footer-public a {
            color: var(--color-gold);
            text-decoration: none;
        }

        .footer-public a:hover {
            color: var(--color-gold-light);
        }

        /* Card Styles */
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid rgba(255,255,255,0.8);
            overflow: hidden;
        }

        .card-header-custom {
            background: var(--gradient-primary);
            padding: 1.75rem 2rem;
            color: white;
            position: relative;
        }

        .card-header-custom::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: white;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .card-header-custom h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            position: relative;
            z-index: 1;
        }

        .card-header-custom p {
            opacity: 0.9;
            font-size: 0.9rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .card-body-custom {
            padding: 2rem;
        }

        /* Form Styles */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--color-primary);
            margin-bottom: 1.25rem;
        }

        .form-section-title i {
            font-size: 1.25rem;
            color: var(--color-gold);
        }

        .form-label {
            font-weight: 500;
            color: #444;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label .required {
            color: #dc3545;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-control:hover, .form-select:hover {
            border-color: #dee2e6;
            background-color: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(107, 28, 42, 0.1);
            background-color: #fff;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.8rem;
        }

        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.35rem;
        }

        /* Buttons */
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            padding: 0.9rem 2.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(107, 28, 42, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 28, 42, 0.4);
            color: white;
        }

        .btn-primary-custom:active {
            transform: translateY(0);
        }

        .btn-outline-custom {
            border: 2px solid var(--color-primary);
            color: var(--color-primary);
            padding: 0.85rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 12px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--color-primary);
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Select2 Custom Styles */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 48px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .select2-container--bootstrap-5 .select2-selection:hover {
            border-color: #dee2e6;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(107, 28, 42, 0.1);
        }

        /* Alert Custom */
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .alert-danger-custom {
            background: #fef2f2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-brand-text {
                display: none;
            }

            .card-body-custom {
                padding: 1.25rem;
            }

            .card-header-custom {
                padding: 1.25rem;
            }

            .card-header-custom h2 {
                font-size: 1.25rem;
            }
        }

        @stack('styles')
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header-public">
        <div class="container">
            <div class="header-content">
                <a href="{{ url('/') }}" class="header-brand">
                    <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/logo.png') }}" alt="Logo DPR RI">
                    <div class="header-brand-text">
                        <span class="header-brand-title">PUSTEKINFO</span>
                        <span class="header-brand-subtitle">Sistem Internal Data Magang</span>
                        <span class="header-brand-subtitle">Sekretariat Jenderal DPR RI</span>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-public">
        <div class="container">
            <p>&copy; {{ date('Y') }} PUSTEKINFO - Sekretariat Jenderal DPR RI. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
