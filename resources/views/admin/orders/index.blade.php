@extends('admin.layouts.partials.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Daftar Order</h2>

    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="ordersTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-semibold">{{ $order->user->name ?? '-' }}</span>
                            </td>
                            <td>{{ $order->service->name ?? '-' }}</td>
                            <td>
                                @php
                                    $status = strtolower($order->status);
                                    $badge = 'secondary';
                                    if($status === 'completed') $badge = 'success';
                                    elseif($status === 'pending') $badge = 'warning';
                                    elseif($status === 'cancelled') $badge = 'danger';
                                @endphp
                                <span class="badge bg-{{ $badge }} text-capitalize px-3 py-2">
                                    {{ ucfirst($order->status) ?? 'Pending' }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#ordersTable').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "zeroRecords": "Data tidak ditemukan"
            }
        });
    });
</script>
<style>
    .card {
        border-radius: 1.2rem;
    }
    .table thead th {
        font-weight: 600;
        letter-spacing: .5px;
    }
    .badge {
        font-size: 0.95rem;
        letter-spacing: .3px;
    }
</style>
@endsection