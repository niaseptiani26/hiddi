@extends('layouts.pelanggan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --hiddi-gold: #D4AF37;
        --hiddi-dark-gold: #B8962E;
        --hiddi-soft-gold: rgba(212, 175, 55, 0.08);
        --hiddi-dark: #1A1A1A;
        --hiddi-gray: #646464;
        --hiddi-light-gray: #F8F9FA;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #FFFFFF;
        color: var(--hiddi-dark);
    }

    .display-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--hiddi-dark);
        line-height: 1.2;
    }

    /* Navigation */
    .back-link {
        color: var(--hiddi-gray);
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
    }
    .back-link:hover {
        color: var(--hiddi-gold);
        transform: translateX(-5px);
    }

    /* Card Styling */
    .glass-card {
        background: #ffffff;
        border: 1px solid #EDEDED;
        border-radius: 24px;
    }

    .hiddi-badge {
        background-color: var(--hiddi-soft-gold);
        color: var(--hiddi-dark-gold);
        font-weight: 600;
        font-size: 0.7rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 8px 20px;
        border-radius: 50px;
    }

    /* Service Section */
    .service-box {
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        border: 1px solid #F0F0F0;
        transition: 0.3s;
    }
    .service-box:hover {
        border-color: var(--hiddi-gold);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .service-title {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        color: var(--hiddi-dark);
    }
    .service-title i {
        color: var(--hiddi-gold);
        margin-right: 12px;
        font-size: 1.2rem;
    }

    .include-list {
        list-style: none;
        padding: 0;
    }
    .include-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 14px;
        font-size: 0.92rem;
        color: var(--hiddi-gray);
        line-height: 1.5;
    }
    .include-list li::before {
        content: "\f058";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: var(--hiddi-gold);
    }

    /* Buttons */
    .btn-hiddi-primary {
        background: linear-gradient(135deg, var(--hiddi-gold) 0%, var(--hiddi-dark-gold) 100%);
        color: #fff;
        border: none;
        padding: 18px;
        border-radius: 16px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-hiddi-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(212, 175, 55, 0.25);
        color: #fff;
    }

    .btn-hiddi-outline {
        border: 2px solid #EAEAEA;
        color: var(--hiddi-dark);
        padding: 16px;
        border-radius: 16px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-hiddi-outline:hover {
        background-color: #25D366;
        border-color: #25D366;
        color: #fff;
    }

    .price-tag {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--hiddi-dark);
        letter-spacing: -1px;
    }

    .sticky-sidebar {
        top: 100px;
    }
</style>

<div class="container py-5 mt-4">
    
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-5">
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-chevron-left me-2"></i> Kembali ke Daftar Paket
        </a>
    </div>

    <div class="row g-5">
        
        {{-- LEFT COLUMN: CONTENT --}}
        <div class="col-lg-8">
            <div class="mb-5">
                <span class="hiddi-badge mb-3 d-inline-block">{{ $package->category->name }}</span>
                <h1 class="display-title mb-4">{{ $package->name }}</h1>
            </div>

            @if($package->notes)
            <div class="glass-card p-4 mb-5 bg-light border-0">
                <h6 class="fw-bold mb-3 small text-uppercase" style="letter-spacing: 1.2px; color: var(--hiddi-dark-gold);">
                    <i class="fas fa-info-circle me-2"></i>Informasi Penting
                </h6>
                <div class="row g-3">
                    @foreach(array_filter(explode('*', $package->notes)) as $note)
                    <div class="col-md-6">
                        <p class="small text-muted mb-0 d-flex align-items-center">
                            <i class="fas fa-check me-2 text-gold" style="font-size: 0.7rem;"></i>
                            {{ trim($note) }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <h5 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-gold me-3" style="width: 40px; height: 2px;"></span>
                Rincian Layanan
            </h5>
            
            <div class="row g-4 mb-5">
                @if($package->includes->where('type','prewedding')->count())
                <div class="col-md-6">
                    <div class="service-box">
                        <div class="service-title"><i class="fas fa-camera-retro"></i> Pre-Wedding</div>
                        <ul class="include-list">
                            @foreach($package->includes->where('type','prewedding') as $item)
                            <li>{{ $item->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if($package->includes->where('type','wedding')->count())
                <div class="col-md-6">
                    <div class="service-box">
                        <div class="service-title"><i class="fas fa-heart"></i> Wedding Day</div>
                        <ul class="include-list">
                            @foreach($package->includes->where('type','wedding') as $item)
                            <li>{{ $item->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if($package->includes->where('type','general')->count())
                <div class="col-12">
                    <div class="service-box bg-dark">
                        <div class="service-title text-white"><i class="fas fa-crown text-gold"></i> Exclusive Benefits</div>
                        <div class="row">
                            @foreach($package->includes->where('type','general') as $item)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center text-white-50">
                                    <i class="fas fa-star text-gold me-2" style="font-size: 0.8rem;"></i>
                                    <span class="small">{{ $item->title }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- RIGHT COLUMN: ACTION --}}
        <div class="col-lg-4">
            <div class="sticky-sidebar">
                <div class="glass-card shadow-sm p-4 p-xl-5 text-center">
                    <p class="text-muted small mb-2 uppercase fw-bold">Investasi Mulai Dari</p>
                    <div class="price-tag mb-4">Rp {{ number_format($package->price,0,',','.') }}</div>
                    
                    <div class="d-grid gap-3">
@if(strtolower($package->category->name) !== 'addition')
    <a href="{{ route('booking.index', ['package_id' => $package->id]) }}" class="btn btn-gold">
        Booking Sekarang
    </a>
@endif

                        <a href="https://wa.me/6282124591059?text=Halo Hiddi Organize, saya ingin bertanya mengenai paket {{ urlencode($package->name) }}"
                           target="_blank"
                           class="btn btn-hiddi-outline">
                            <i class="fab fa-whatsapp me-2"></i> Chat Konsultasi
                        </a>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <div class="d-flex justify-content-center gap-3 mb-3 text-muted opacity-50">
                            <i class="fas fa-award fa-lg"></i>
                            <i class="fas fa-shield-check fa-lg"></i>
                            <i class="fas fa-calendar-check fa-lg"></i>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">
                            Setiap reservasi akan diproses secara resmi oleh sistem <strong>Hiddi Organize</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection