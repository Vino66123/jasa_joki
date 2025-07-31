@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Dashboard Saya</h2>
            <p class="text-muted">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Pesanan</h5>
                    <h3 class="fw-bold">{{ $stats['total_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h5 class="card-title text-muted">Selesai</h5>
                    <h3 class="fw-bold">{{ $stats['completed_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title text-muted">Dalam Proses</h5>
                    <h3 class="fw-bold">{{ $stats['pending_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Pengeluaran</h5>
                    <h3 class="fw-bold">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Terbaru -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pesanan Terbaru</h5>
            <a href="{{ route('customer.dashboard.order-history') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->service->name }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'primary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('customer.dashboard.order-detail', $order->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <img src="{{ asset('images/empty-order.svg') }}" alt="No orders" width="200" class="mb-3">
                    <h5>Belum ada pesanan</h5>
                    <p class="text-muted">Mulai buat pesanan pertama Anda</p>
                    <a href="{{ route('customer.dashboard.create-order') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Pesan Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Rekomendasi Layanan -->
    @if($recommendedServices->count() > 0)
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Rekomendasi Layanan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($recommendedServices as $service)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">Rp {{ number_format($service->base_price, 0, ',', '.') }}</span>
                                <a href="{{ route('customer.services.show', $service->id) }}" class="btn btn-sm btn-outline-primary">
                                    Detail <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection