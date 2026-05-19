{{-- Kadiha Muhamad --}}
@extends('layouts.app')

@section('title', __('allied.title'))

@section('content')
@include('components.breadcrumbs', ['breadcrumbs' => [
    ['label' => __('app.home'), 'url' => route('home.index')],
    ['label' => __('allied.title'), 'url' => '#'],
]])

<section class="mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h2 class="mb-1">{{ __('allied.store_name') }}</h2>
            <p class="text-muted mb-0 fs-5">{{ __('allied.subtitle') }}</p>
        </div>
        <a href="{{ $viewData['storeLink'] }}" target="_blank" class="btn btn-outline-secondary">
            {{ __('allied.visit_store') }}
        </a>
    </div>
</section>

@if($viewData['byCategory']->isEmpty())
    <div class="text-center text-muted py-5 border rounded-3">
        {{ __('allied.no_products') }}
    </div>
@else
    @foreach($viewData['byCategory'] as $category => $products)
        <h4 class="mt-4 mb-3">{{ $category }}</h4>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
            @foreach($products as $plant)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title mb-1">{{ $plant['name'] }}</h5>

                            <p class="small text-muted flex-grow-1 mt-1">
                                {{ $plant['description'] }}
                            </p>

                            <ul class="list-unstyled small text-muted mt-2">
                                @if($plant['color'] !== 'N/A')
                                    <li>{{ __('allied.color') }}: {{ $plant['color'] }}</li>
                                @endif
                                <li>{{ __('allied.size') }}: {{ $plant['size'] }}</li>
                                <li>{{ __('allied.stock') }}: {{ $plant['stock'] }}</li>
                            </ul>

                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <p class="fw-bold fs-5 mb-0">
                                    ${{ number_format($plant['price'], 0, ',', '.') }}
                                </p>
                                <a href="{{ $plant['url'] }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                    {{ __('allied.view') }}
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endif
@endsection