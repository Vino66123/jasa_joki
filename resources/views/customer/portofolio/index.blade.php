@extends('layouts.customer')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Portfolio Kami</h2>
            <p class="text-muted">Beberapa contoh website yang telah kami buat</p>
        </div>
        
        <div class="row g-4">
            @foreach($portfolios as $portfolio)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $portfolio->image_url }}" class="card-img-top" alt="{{ $portfolio->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $portfolio->title }}</h5>
                        <p class="card-text">{{ $portfolio->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $portfolio->completed_date->format('d M Y') }}</small>
                            @if($portfolio->url)
                            <a href="{{ $portfolio->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                Kunjungi <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $portfolios->links() }}
        </div>
    </div>
</section>
@endsection