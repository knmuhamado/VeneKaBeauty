<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>@yield('title', __('app.site_name'))</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home.index') }}">
          <i class="bi bi-house-door-fill"></i>
          {{ __('app.site_name') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">

          <a class="nav-link" href="{{ route('product.index') }}">
              {{ __('app.nav_products') }}
          </a>

          @auth
            @if(Auth::user()->role === 'admin')
                <a class="nav-link" href="{{ route('admin.product.index') }}">
                    {{ __('app.nav_admin') }}
                </a>
            @endif
          @endauth

          @guest
              <a class="nav-link" href="{{ route('login') }}">Login</a>
              <a class="nav-link" href="{{ route('register') }}">Register</a>
          @else
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link" style="border:none;">
                      Logout
                  </button>
              </form>
          @endguest

        </div>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <main class="container my-4 flex-grow-1">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <div class="container">
      <small>
        {{ __('app.footer_copyright', ['year' => date('Y')]) }}
      </small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

</body>
</html>
