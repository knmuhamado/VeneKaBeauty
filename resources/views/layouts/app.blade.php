{{-- David Alejandro Gutiérrez Leal --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', __('app.site_name'))</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <i class="bi bi-house-door-fill" aria-hidden="true"></i>
                {{ __('app.site_name') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="{{ __('app.toggle_navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto align-items-center gap-1">

                    <a class="nav-link" href="{{ route('product.index') }}">
                        {{ __('app.nav_products') }}
                    </a>

                    @guest
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('user.login') }}
                        </a>

                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('user.register') }}
                        </a>
                    @else
                        {{-- Admin --}}
                        @if(auth()->user()->isAdmin())
                            <a class="nav-link" href="{{ route('admin.product.index') }}">
                                {{ __('app.nav_admin') }}
                            </a>
                        @endif

                        {{-- Cliente --}}
                        @if(auth()->user()->isClient())
                            <a class="nav-link" href="{{ route('order.list') }}">
                                {{ __('app.nav_my_orders') }}
                            </a>
                        @endif

                        {{-- Logout --}}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border:none;">
                                {{ __('user.logout') }}
                            </button>
                        </form>
                    @endguest

                </div>
            </div>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    {{-- Carrito flotante solo para clientes autenticados --}}
    @auth
        @if(auth()->user()->isClient())
            @php
                $cartCount = collect(session('cart', []))->sum('quantity');
            @endphp
            <a href="{{ route('cart.index') }}"
               class="cart-float {{ $cartCount > 0 ? 'cart-float--active' : '' }}">
                <span class="cart-float__icon"><i class="bi bi-cart-fill" aria-hidden="true"></i></span>
                @if($cartCount > 0)
                    <span class="cart-float__badge">{{ $cartCount }}</span>
                @endif
                <span class="cart-float__label">
                    {{ $cartCount > 0 ? __('cart.view_cart') : __('cart.empty_cart_short') }}
                </span>
            </a>
        @endif
    @endauth

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>
                {{ __('app.footer_copyright', ['year' => date('Y')]) }}
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    @stack('scripts')
</body>
</html>
