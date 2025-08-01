<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head')
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('admin.layouts.partials.sidebar')
            <!-- Main Content -->
            <div class="col-md-10 main-content p-0">
                <!-- Top Navigation -->
                @include('admin.layouts.partials.topbar')
                <!-- Content -->
                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.scripts')
</body>
</html>