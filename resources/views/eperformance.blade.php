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
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>

    <style>
        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }
        
        .loading-screen.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        
        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: white;
            font-size: 1.2rem;
            font-weight: 300;
            text-align: center;
            margin-top: 10px;
        }
        
        .loading-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 30px;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        
        .portal-header {
            text-align: center;
            padding: 40px 0;
            margin-bottom: 30px;
        }
        
        .portal-title {
            color: white;
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 10px;
        }
        
        .portal-subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 1.2rem;
            font-weight: 300;
        }
        
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
            padding: 0 20px;
        }
        
        .card-module {
            width: 280px;
            height: 200px;
            transition: all 0.4s ease;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 25px;
        }
        
        .card-module:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }
        
        .card-file-icon {
            height: 120px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .card-file-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
        }
        
        .card-file-icon.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-file-icon.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        
        .card-file-icon img {
            max-height: 70px;
            max-width: 70px;
            object-fit: contain;
            position: relative;
            z-index: 2;
        }
        
        .card-body {
            flex: 1;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .card-body b {
            font-size: 0.85rem;
            line-height: 1.3;
            display: block;
            color: #333;
        }
        
        .text-decoration-none:hover .card-body b {
            color: #667eea !important;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .card-module:nth-child(odd) {
            animation: float 6s ease-in-out infinite;
        }
        
        .card-module:nth-child(even) {
            animation: float 6s ease-in-out infinite 3s;
        }
        
        @media (max-width: 1200px) {
            .card-module {
                width: 250px;
                height: 180px;
            }
        }
        
        @media (max-width: 768px) {
            .portal-title {
                font-size: 2rem;
            }
            
            .card-module {
                width: 220px;
                height: 160px;
            }
            
            .cards-container {
                gap: 15px;
                padding: 0 10px;
            }
        }
        
        @media (max-width: 480px) {
            .card-module {
                width: 280px;
                height: 140px;
            }
            
            .cards-container {
                gap: 10px;
            }
        }
    </style>


</head>

<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <img src="{{ asset('logo/logo.png') }}" alt="DPR RI Logo" class="loading-logo">
        <div class="spinner"></div>
        <div class="loading-text">
            Memuat ePerformance Portal<br>
            <small>Dewan Perwakilan Rakyat Republik Indonesia</small>
        </div>
    </div>

    <div class="portal-header">
        <div class="container">
            <h1 class="portal-title">ePerformance Portal</h1>
            <p class="portal-subtitle">Sistem Terintegrasi Dewan Perwakilan Rakyat Republik Indonesia</p>
        </div>
    </div>

    <div class="container">
        <div class="cards-container">
            
           
            
            <a href="{{ asset('/setjen') }}" class="text-decoration-none">
                <div class="card-module">
                    <div class="card-file-icon success">
                        <img src="{{ asset('logo/logo-setjen-dpr.png') }}" alt="logo">
                    </div>
                    <div class="card-body">
                        <b class="text-uppercase">ADMIN WEB SETJEN</b>
                    </div>
                </div>
            </a>
            
            <a href="{{ asset('/sileg') }}" class="text-decoration-none">
                <div class="card-module">
                    <div class="card-file-icon primary">
                        <img src="{{ asset('logo/logo-setjen-dpr.png') }}" alt="logo">
                    </div>
                    <div class="card-body">
                        <b class="text-uppercase">SILEG</b>
                    </div>
                </div>
            </a>
            
            <a href="https://eperformance.dpr.go.id/magang-pustekinfo/admin" class="text-decoration-none">
                <div class="card-module">
                    <div class="card-file-icon primary">
                        <img src="{{ asset('logo/logo-pustekinfo.png') }}" alt="logo" style="max-height: 200px; max-width: 200px;">
                    </div>
                    <div class="card-body">
                        <b class="text-uppercase">PUSTEKINFO INTERNSHIP</b>
                    </div>
                </div>
            </a>
            
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Loading Screen Script -->
    <script>
        $(document).ready(function() {
            // Hide loading screen after page is fully loaded
            $(window).on('load', function() {
                setTimeout(function() {
                    $('#loadingScreen').addClass('fade-out');
                    setTimeout(function() {
                        $('#loadingScreen').remove();
                    }, 500);
                }, 800); // Delay 800ms to show loading animation
            });
        });
    </script>

</body>

</html>
