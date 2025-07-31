@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Website Profesional untuk Bisnis Anda</h1>
                <p class="lead mb-4">Kami menyediakan jasa pembuatan website berkualitas dengan harga terjangkau dan pengerjaan cepat.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('customer.services.index') }}" class="btn btn-light btn-lg px-4">
                        Lihat Layanan <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="#portfolio" class="btn btn-outline-light btn-lg px-4">
                        Portfolio Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://possore.id/wp-content/uploads/2024/08/jasa-pembuatan-website-imortaweb.webp" alt="Hero Image" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Layanan Populer -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Layanan Populer Kami</h2>
            <p class="text-muted">Pilih layanan yang sesuai dengan kebutuhan Anda</p>
        </div>
        <div class="row g-4">
            @foreach($popularServices as $service)
            <div class="col-md-4">
                <div class="service-card card h-100">
                    <img src="{{ $service->image_url ?? 'https://idwebhost.com/themes/midnight/assets/revamp/img/og-fb/jasa-pembuatan-website.jpg' }}" class="card-img-top" alt="{{ $service->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price-tag">Rp {{ number_format($service->base_price, 0, ',', '.') }}</span>
                            <a href="{{ route('customer.services.show', $service->id) }}" class="btn btn-sm btn-primary">
                                Pesan Sekarang <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('customer.services.index') }}" class="btn btn-outline-primary">
                Lihat Semua Layanan <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Portfolio -->
<section id="portfolio" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Portfolio Kami</h2>
            <p class="text-muted">Beberapa contoh website yang telah kami buat</p>
        </div>
        <div class="row g-4">
            @foreach($portfolios as $portfolio)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ $portfolio->image_url }}" class="card-img-top" alt="{{ $portfolio->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $portfolio->title }}</h5>
                        <p class="card-text">{{ $portfolio->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni -->
<section id="testimoni" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Apa Kata Klien Kami?</h2>
            <p class="text-muted">Testimoni dari klien yang puas dengan layanan kami</p>
        </div>
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="card-text fst-italic">"{{ $testimonial->comment }}"</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->user->name) }}&background=random" 
                                 class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <h6 class="mb-0">{{ $testimonial->user->name }}</h6>
                                <small class="text-muted">{{ $testimonial->user->role === 'admin' ? 'Tim WebJoki' : 'Klien' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection