@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Admin</h2>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card-counter primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="count-numbers">{{ $totalOrders }}</span>
                        <span class="count-name">Total Pesanan</span>
                    </div>
                    <i class="fas fa-shopping-cart fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="count-numbers">{{ $pendingOrders }}</span>
                        <span class="count-name">Pesanan Pending</span>
                    </div>
                    <i class="fas fa-clock fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="count-numbers">{{ $totalCustomers }}</span>
                        <span class="count-name">Total Pelanggan</span>
                    </div>
                    <i class="fas fa-users fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="count-numbers">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                        <span class="count-name">Total Pendapatan</span>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pesanan Terbaru</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
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
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->service->name }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'primary') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection