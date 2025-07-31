@extends('layouts.customer')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold">Semua Layanan Kami</h2>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('services.index') }}?sort=price_asc">Harga Terendah</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('services.index') }}?sort=price_desc">Harga
                                Tertinggi</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.index') }}?sort=newest">Terbaru</a></li>
                    </ul>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-4">
                        <div class="service-card card h-100">
                            <img src="{{ $service->image_url ?? 'https://via.placeholder.com/300x200' }}"
                                class="card-img-top" alt="{{ $service->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i> Pengerjaan:
                                        {{ $service->delivery_time }} hari</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Revisi:
                                        {{ $service->revision_limit }}x</li>
                                </ul>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-tag">Rp {{ number_format($service->base_price, 0, ',', '.') }}</span>
                                    <a href="{{ route('customer.services.show', $service->id) }}"
                                        class="btn btn-primary btn-sm">
                                        Detail <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $services->links() }}
            </div>
        </div>
    </section>
@endsection
