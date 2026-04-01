{{-- Kadiha Muhamad --}}
@extends('layouts.app')

@section('title', __('order.title'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{ __('order.my_orders') }}</h2>

    @include('layouts._success_alert')

    @if($viewData['orders']->isEmpty())
        <div class="alert alert-info">{{ __('order.empty_registered') }}</div>
    @else
        <div class="row">
            @foreach($viewData['orders'] as $order)
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h5 class="card-title">{{ __('order.order_number') }}{{ $order->getId() }}</h5>
                            <p class="card-text">
                                <small>{{ $order->getCreatedAt() }}</small><br>
                                <small>$ {{ number_format($order->getTotal(), 0, ',', '.') }}</small>
                            </p>
                            <a href="{{ route('order.show', ['id' => $order->getId()]) }}"
                               class="btn btn-lila text-white mt-auto">
                                {{ __('order.show_title') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection