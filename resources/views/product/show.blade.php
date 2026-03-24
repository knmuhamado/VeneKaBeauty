{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<h2>{{ __('product.detail') }}</h2>

<div class="card" style="width: 25rem;">
    <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top" alt="{{ $product->getName() }}">

    <div class="card-body">
        <h5 class="card-title">{{ $product->getName() }}</h5>
        <p class="card-text">{{ $product->getDescription() }}</p>

        <p><strong>{{ __('product.price') }}:</strong> ${{ $product->getPrice() }}</p>
        <p><strong>{{ __('product.available') }}:</strong> {{ $product->getAvailable() ? __('product.yes') : __('product.no') }}</p>
        <p><strong>{{ __('product.brand') }}:</strong> {{ $product->getBrand() ?? __('product.not_available') }}</p>
        <p><strong>{{ __('product.category') }}:</strong> {{ $product->getCategory()?->getName() ?? __('product.not_available') }}</p>
        <p><strong>{{ __('product.type') }}:</strong> {{ $product->getType() }}</p>

        <p><strong>{{ __('product.keywords') }}:</strong>
            @if($product->getKeyword())
                {{ implode(', ', $product->getKeyword()) }}
            @else
                {{ __('product.not_available') }}
            @endif
        </p>

        <a href="{{ route('product.index') }}" class="btn btn-secondary">{{ __('product.back') }}</a>
    </div>
</div>
@endsection
