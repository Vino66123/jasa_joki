@extends('admin.layouts.partials.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayaran as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->order->user->name }}</td>
                    <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status == 'paid')
                            <span class="badge bg-success">Berhasil</span>
                        @elseif($item->status == 'expired')
                            <span class="badge bg-warning">Expired</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                            Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<!-- Modal Detail Pembayaran -->
@foreach($pembayaran as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.payments.update', $item->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID Pembayaran:</strong> {{ $item->id }}</p>
                    <p><strong>Nama Pengguna:</strong> {{ $item->order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $item->order->user->email }}</p>
                    <p><strong>Jumlah:</strong> Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                    <p><strong>Status Saat Ini:</strong> 
                        @if($item->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status == 'paid')
                            <span class="badge bg-success">Berhasil</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </p>
                    <p><strong>Tanggal:</strong> {{ $item->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Order ID:</strong> {{ $item->order_id }}</p>

                    <div class="mb-3 mt-3">
                        <label for="status-{{ $item->id }}" class="form-label">Ubah Status:</label>
                        <select name="status" id="status-{{ $item->id }}" class="form-select">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $item->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="expired" {{ $item->status == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="failed" {{ $item->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Status</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach


@endsection