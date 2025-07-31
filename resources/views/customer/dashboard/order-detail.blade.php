@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Pesanan #{{ $order->id }}</h5>
                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'primary') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Layanan</h6>
                            <p>{{ $order->service->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Tanggal Pesanan</h6>
                            <p>{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Total Pembayaran</h6>
                            <p class="fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Deadline</h6>
                            <p>{{ $order->deadline ? $order->deadline->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6>Kebutuhan Anda</h6>
                        <div class="border p-3 rounded bg-light">
                            {!! nl2br(e($order->requirements)) !!}
                        </div>
                    </div>
                    @if($order->admin_notes)
                    <div class="mb-3">
                        <h6>Catatan Admin</h6>
                        <div class="border p-3 rounded bg-light">
                            {!! nl2br(e($order->admin_notes)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Progress Pengerjaan -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Progress Pengerjaan</h5>
                </div>
                <div class="card-body">
                    @if($order->progresses->count() > 0)
                        <div class="timeline">
                            @foreach($order->progresses as $progress)
                            <div class="timeline-item {{ $loop->last ? 'last' : '' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ $progress->title }}</h6>
                                        <span class="badge bg-{{ $progress->status == 'completed' ? 'success' : 'info' }}">
                                            {{ ucfirst($progress->status) }}
                                        </span>
                                    </div>
                                    <p class="text-muted">{{ $progress->description }}</p>
                                    <small class="text-muted">{{ $progress->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">Belum ada progress pengerjaan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Pembayaran -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    @if($order->payments->count() > 0)
                        @foreach($order->payments as $payment)
                        <div class="mb-3">
                            <h6>Metode Pembayaran</h6>
                            <p>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
                            
                            <h6>Status</h6>
                            <p>
                                <span class="badge bg-{{ $payment->status == 'paid' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </p>
                            
                            @if($payment->proof)
                            <h6>Bukti Pembayaran</h6>
                            <a href="{{ asset('storage/' . $payment->proof) }}" target="_blank" class="d-block mb-3">
                                <img src="{{ asset('storage/' . $payment->proof) }}" alt="Bukti pembayaran" class="img-thumbnail" style="max-height: 150px;">
                            </a>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted mb-3">Belum ada pembayaran</p>
                        <a href="{{ route('customer.dashboard.payment', $order->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                        </a>
                    @endif
                </div>
            </div>

            <!-- Testimoni -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Testimoni Anda</h5>
                </div>
                <div class="card-body">
                    @if($order->status == 'completed')
                        @if($order->testimonial)
                            <div class="d-flex mb-3">
                                @for($i = 0; $i < $order->testimonial->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                            <p class="fst-italic">"{{ $order->testimonial->comment }}"</p>
                            <small class="text-muted">Dikirim pada {{ $order->testimonial->created_at->format('d M Y') }}</small>
                        @else
                            <p class="text-muted mb-3">Anda belum memberikan testimoni</p>
                            <a href="{{ route('customer.dashboard.create-testimonial', $order->id) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-comment me-2"></i> Beri Testimoni
                            </a>
                        @endif
                    @else
                        <p class="text-muted">Testimoni dapat diberikan setelah pesanan selesai</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection