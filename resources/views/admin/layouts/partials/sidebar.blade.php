<div class="col-md-2 sidebar p-0">
    <div class="text-center p-3 bg-dark">
        <h4 class="text-white">Admin Panel</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-shopping-cart me-2"></i>Pesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                <i class="fas fa-laptop-code me-2"></i>Layanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                <i class="fas fa-users me-2"></i>Pelanggan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/payments*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
                <i class="fas fa-credit-card me-2"></i>Pembayaran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/add-admin') ? 'active' : '' }}" href="{{ route('admin.create-admin') }}">
                <i class="fas fa-user-plus me-2"></i>Tambah Admin
            </a>
        </li>
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </li>
    </ul>
</div>