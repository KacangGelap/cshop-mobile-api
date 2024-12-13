<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    <script src="/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div id="app" class="d-flex flex-column flex-lg-row bg-secondary">
        <div class="col-lg-3 d-flex flex-column flex-shrink-0 p-3 text-white bg-dark rounded-3 m-3" style="max-width: 100%; min-width: 0;">
          <a href="/" class="d-flex justify-content-around mb-3 mb-md-0 me-md-auto text-white text-decoration-none align-items-center">
            <img src="/img/favicon.png" class="w-25">
            <span class="fs-4">Ctrl+Shop</span>
          </a>
          <hr>
      
          <!-- Toggle Button for Smaller Devices -->
          <button class="btn btn-outline-light d-sm-none mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarItems" aria-expanded="false" aria-controls="sidebarItems">
            Menu
          </button>
          <div class="h-100">
            <div class="collapse d-sm-block" id="sidebarItems">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                      <a href="{{route('home')}}" class="nav-link text-white @if(Route::current()->getName() == 'home') active @endif" aria-current="page">
                        <i class="bi-house"></i>
                        Dashboard
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white @if(Route::current()->getName() == 'order.index') active @endif">
                        <i class="bi-list-ol"></i>
                        Orders
                      </a>
                    </li>
                    <li>
                      <a href="{{route('product.index')}}" class="nav-link text-white @if(Route::current()->getName() == 'product.index') active @endif">
                        <i class="bi-boxes"></i>
                        Products
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white @if(Route::current()->getName() == 'user') active @endif">
                        <i class="bi-person-fill"></i>
                        Customers
                      </a>
                    </li>
                  </ul>
            </div>
          </div>
      
          <hr>
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/kacanggelap.png" alt="" width="32" height="32" class="rounded-circle me-2">
              <strong>{{Auth::User()->name}}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </ul>
          </div>
        </div>
      
        <main class="flex-fill py-4 min-vh-100">
          @yield('content')
        </main>
      </div>
    @if (session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast show align-items-center bg-success-subtle border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    Success
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                
        </div>
    </div>
    @endif
    @if (session('fail'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast show align-items-center bg-danger-subtle border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    Failed
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('fail') }}
                </div>
                
        </div>
    </div>
    @endif
    <script>
    const toastLiveExample = document.getElementById('liveToast');
    if (toastLiveExample) {
        const toast = new bootstrap.Toast(toastLiveExample);
        toast.show();
    }
    </script>

      
</body>
</html>
