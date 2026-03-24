{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<section class="mb-4">
    <h2 class="mb-2">{{ __('home.welcome_title') }}</h2>
    <p class="text-muted mb-3">{{ __('home.welcome_subtitle') }}</p>
</section>

<section>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">{{ __('home.featured_products') }}</h3>
        <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-primary">
            {{ __('home.view_catalog') }}
        </a>
    </div>

    @include('layouts._success_alert')

    @if($featuredProducts->isEmpty())
        <p class="text-muted">{{ __('home.no_featured') }}</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($featuredProducts as $product)
                @php
                    $cart     = session('cart', []);
                    $pid      = (string) $product->getId();
                    $quantity = $cart[$pid]['quantity'] ?? 0;
                @endphp
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($product->getImage())
                            <img src="{{ asset('storage/' . $product->getImage()) }}"
                                 class="card-img-top"
                                 style="height: 200px; object-fit: cover;"
                                 alt="{{ $product->getName() }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->getName() }}</h5>
                            <p class="text-muted small mb-1">
                                {{ $product->getCategory()?->getName() ?? 'Sin categoría' }}
                            </p>
                            <p class="fw-bold mb-3">
                                $ {{ number_format($product->getPrice(), 0, ',', '.') }}
                            </p>

                            <div class="mt-auto">
                                @auth
                                    @if(auth()->user()->isClient())
                                        @if($quantity > 0)
                                            <div class="d-flex align-items-center justify-content-between border rounded px-3 py-2">
                                                <a href="{{ route('cart.decrease', $product->getId()) }}"
                                                   class="btn btn-outline-danger btn-sm fw-bold"
                                                   style="width: 32px;">−</a>

                                                <span class="fw-bold mx-2">{{ $quantity }}</span>

                                                <a href="{{ route('cart.add', $product->getId()) }}"
                                                   class="btn btn-outline-success btn-sm fw-bold"
                                                   style="width: 32px;">+</a>
                                            </div>
                                        @else
                                            <a href="{{ route('cart.add', $product->getId()) }}"
                                               class="btn btn-lila w-100">
                                                {{ __('home.add_to_cart') }}
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
                                        {{ __('home.login_to_buy') }}
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection