<nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <div class="ms-auto d-flex align-items-center">
           @if(auth()->check())
                <span class="me-3">{{ auth()->user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" 
                    class="rounded-circle" width="40" height="40">
            @else
                <span class="me-3">Guest</span>
            @endif
        </div>
    </div>
</nav>