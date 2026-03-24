{{-- Kadiha Muhamad --}}
@extends('layouts.app')

@section('title', __('order.show_title'))

@section('content')
<div class="container mt-4">

    @include('layouts._success_alert')

    <div class="card mb-4">
        <div class="card-header">
            <h4>{{ __('order.order_number') }}{{ $viewData['order']->getId() }}</h4>
        </div>
        <div class="card-body">
            <p>
                <strong>{{ __('order.total') }}:</strong>
                $ {{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}
            </p>
            <p>
                <strong>{{ __('order.date') }}:</strong>
                {{ $viewData['order']->getDate() }}
            </p>
            <p>
                <strong>{{ __('order.paid') }}:</strong>
                {{ $viewData['order']->getPaid() ? __('order.paid_yes') : __('order.paid_no') }}
            </p>
            <p>
                <strong>{{ __('order.shipped') }}:</strong>
                {{ $viewData['order']->getShipped() ? __('order.shipped_yes') : __('order.shipped_no') }}
            </p>
            <p>
                <strong>{{ __('order.method_of_payment') }}:</strong>
                {{ __('order.payment_' . $viewData['order']->getMethodOfPayment()) }}
            </p>
        </div>
    </div>

    @include('orders._items', ['items' => $viewData['items']])

    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('order.pdf', $viewData['order']->getId()) }}"
           class="btn btn-outline-dark"
           target="_blank">
            {{ __('order.download_pdf') }}
        </a>

        <a href="{{ route('order.delete', ['id' => $viewData['order']->getId()]) }}"
           class="btn btn-danger"
           onclick="return confirm('{{ __('order.delete_confirm') }}')">
            {{ __('order.delete') }}
        </a>

        <a href="{{ route('order.list') }}" class="btn btn-secondary">
            {{ __('order.back') }}
        </a>
    </div>

</div>
@endsection