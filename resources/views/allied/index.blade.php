{{-- Kadiha Muhamad --}}
@extends('layouts.app')

@section('title', __('allied.title'))

@section('content')
@include('components.breadcrumbs', ['breadcrumbs' => [
    ['label' => __('app.home'), 'url' => route('home.index')],
    ['label' => __('allied.title'), 'url' => '#'],
]])

<section class="mb-4">
    <h2 class="mb-2">{{ __('allied.title') }}</h2>
    <p class="text-muted mb-3 fs-5">{{ __('allied.subtitle') }}</p>
</section>

@if(empty($phones))
    <div class="text-center text-muted py-5 border rounded-3">
        {{ __('allied.no_products') }}
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($phones as $phone)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title mb-1">{{ $phone['name'] }}</h5>

                        <p class="text-muted small mb-1">
                            <span class="badge bg-light text-dark border">{{ $phone['brand'] }}</span>
                        </p>

                        <ul class="list-unstyled small text-muted flex-grow-1 mt-2">
                            <li>{{ __('allied.memory') }}: {{ $phone['memory'] }} GB</li>
                            <li>{{ __('allied.ram') }}: {{ $phone['ram'] }} GB</li>
                            <li>{{ __('allied.battery') }}: {{ $phone['battery'] }} mAh</li>
                            <li>{{ __('allied.stock') }}: {{ $phone['quantity'] }}</li>
                        </ul>

                        <p class="fw-bold fs-5 mb-0 mt-3">
                            ${{ number_format($phone['price'], 0, ',', '.') }}
                        </p>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection