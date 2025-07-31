@extends('layouts.customer')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Apa Kata Klien Kami?</h2>
            <p class="text-muted">Testimoni dari klien yang puas dengan layanan kami</p>
        </div>
        
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
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
                                <small class="text-muted">Klien {{ $testimonial->created_at->format('M Y') }}</small>
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