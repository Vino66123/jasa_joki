<!DOCTYPE html>
<html lang="en">
    @include('customer.layouts.partials.head')
<body>
    <!-- Navigation -->
        @include('customer.layouts.partials.sidebar')
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
        @include('customer.layouts.partials.footer')
    <!-- Scripts -->
        @include('customer.layouts.partials.scripts')
</body>
</html>