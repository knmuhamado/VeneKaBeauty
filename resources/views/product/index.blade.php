{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<section class="mb-4">
    <h2 class="mb-2">{{ __('product.title') }}</h2>
    <p class="text-muted mb-3 fs-5">{{ __('home.welcome_subtitle') }}</p>
</section>

<x-product.filter
    action-route="product.index"
    :query="$query"
    :categories="$categories"
    :has-filters="$hasFilters"
/>

@if($products->isEmpty())
    <div class="text-center text-muted py-5 border rounded-3">
        {{ __('product.empty_not_found') }}
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('product.show', $product->getId()) }}" class="text-decoration-none">
                        @if($product->getImage())
                            <img src="{{ asset('storage/' . $product->getImage()) }}"
                                 class="card-img-top"
                                 style="height: 220px; object-fit: cover;"
                                 alt="{{ $product->getName() }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 220px;">
                                <span class="text-muted">{{ __('product.not_available') }}</span>
                            </div>
                        @endif
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">
                            <a href="{{ route('product.show', $product->getId()) }}" class="text-decoration-none text-dark">
                                {{ $product->getName() }}
                            </a>
                        </h5>

                        <p class="text-muted small mb-1">
                            {{ $product->getCategory()?->getName() ?? __('product.not_available') }}
                        </p>

                        <p class="mb-1">
                            <span class="badge bg-light text-dark border">{{ ucfirst($product->getType()) }}</span>
                            <span class="badge {{ $product->getAvailable() ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }}">
                                {{ $product->getAvailable() ? __('product.yes') : __('product.no') }}
                            </span>
                        </p>

                        <p class="small text-muted mb-2">{{ $product->getRating() }}</p>

                        <p class="fw-bold fs-5 mb-3">${{ number_format($product->getPrice(), 0, ',', '.') }}</p>

                        <div class="mt-auto">
                            @if($canBuy)
                                @if(($cartQuantities[$product->getId()] ?? 0) > 0)
                                    <div class="d-flex align-items-center justify-content-between border rounded px-3 py-2 mb-2">
                                        <a href="{{ route('cart.decrease', $product->getId()) }}"
                                           class="btn btn-outline-danger btn-sm fw-bold"
                                           style="width: 32px;">-</a>

                                        <span class="fw-bold mx-2">{{ $cartQuantities[$product->getId()] }}</span>

                                        <a href="{{ route('cart.add', $product->getId()) }}"
                                           class="btn btn-outline-success btn-sm fw-bold"
                                           style="width: 32px;">+</a>
                                    </div>
                                @else
                                    <a href="{{ route('cart.add', $product->getId()) }}" class="btn btn-lila w-100 mb-2">
                                        {{ __('home.add_to_cart') }}
                                    </a>
                                @endif
                            @elseif(! $isLoggedIn)
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 mb-2">
                                    {{ __('home.login_to_buy') }}
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
