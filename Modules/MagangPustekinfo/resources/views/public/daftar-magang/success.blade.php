@extends('magangpustekinfo::layouts.public')

@section('title', 'Data Berhasil Disimpan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-xl-4">
        <div class="success-card animate-fade-in-up">
            <!-- Success Icon -->
            <div class="success-icon-wrapper">
                <div class="success-icon">
                    <svg viewBox="0 0 52 52" class="checkmark">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
            </div>
            
            <!-- Success Message -->
            <div class="success-content">
                <h2>Data Tersimpan!</h2>
                <p>Data peserta magang telah berhasil disimpan ke dalam sistem PUSTEKINFO.</p>
            </div>
            
            <!-- Social Media -->
            <div class="social-media-section">
                <div class="social-text">Ikuti media sosial kami untuk informasi terbaru</div>
                <a href="https://www.instagram.com/pustekinfo.dprri/" target="_blank" class="social-link">
                    <i class="ri-instagram-line"></i>
                    <span>@pustekinfo.dprri</span>
                </a>
            </div>
            
            <!-- Action Buttons -->
            <div class="success-actions">
                <a href="{{ route('magangpustekinfo.daftar_magang.index') }}" class="btn-add-more">
                    <i class="ri-add-circle-line"></i>
                    <span>Input Data Lagi</span>
                </a>
            </div>
            
            <!-- Footer Info -->
            <div class="success-footer">
                <i class="ri-shield-check-line"></i>
                <span>Data dikelola sesuai standar keamanan PUSTEKINFO</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .success-card {
        background: white;
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.04);
    }
    
    /* Success Icon Animation */
    .success-icon-wrapper {
        margin-bottom: 2rem;
    }
    
    .success-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto;
    }
    
    .checkmark {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #4CAF50;
        stroke-miterlimit: 10;
        animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
    }
    
    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 3;
        stroke-miterlimit: 10;
        stroke: #4CAF50;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }
    
    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke-width: 3;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }
    
    @keyframes stroke {
        100% { stroke-dashoffset: 0; }
    }
    
    @keyframes scale {
        0%, 100% { transform: none; }
        50% { transform: scale3d(1.1, 1.1, 1); }
    }
    
    @keyframes fill {
        100% { box-shadow: inset 0px 0px 0px 50px rgba(76, 175, 80, 0.1); }
    }
    
    /* Success Content */
    .success-content {
        margin-bottom: 2rem;
    }
    
    .success-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 0.75rem;
    }
    
    .success-content p {
        font-size: 1rem;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Action Buttons */
    .success-actions {
        margin-bottom: 2rem;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .btn-add-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: var(--gradient-primary);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(107, 28, 42, 0.25);
    }
    
    .btn-add-more:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(107, 28, 42, 0.35);
        color: white;
    }
    
    .btn-add-more i {
        font-size: 1.25rem;
    }
    
    /* Social Media Section */
    .social-media-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        border: 1px solid #dee2e6;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .social-text {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
        font-weight: 500;
    }
    
    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #E1306C, #C13584);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(225, 48, 108, 0.25);
    }
    
    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(225, 48, 108, 0.35);
        color: white;
    }
    
    .social-link i {
        font-size: 1.1rem;
    }
    
    /* Footer Info */
    .success-footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f0f0f0;
        font-size: 0.8rem;
        color: #888;
    }
    
    .success-footer i {
        color: var(--color-gold);
        font-size: 1rem;
    }
    
    /* Animation */
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
</style>
@endpush



