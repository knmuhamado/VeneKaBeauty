@extends('layouts.app')
@section('title', "Order information")
@section('subtitle', "Order details")

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Order #{{ $order->getId() }}</h4>
        <p><strong>Total:</strong> {{ $order->getTotal() }}</p>
        <p><strong>Date:</strong> {{ $order->getDate() }}</p>
        <p><strong>Paid:</strong> {{ $order->getPaid() ? 'Yes' : 'No' }}</p>
        <p><strong>Shipped:</strong> {{ $order->getShipped() ? 'Yes' : 'No' }}</p>
        <p><strong>Method of Payment:</strong> {{ $order->getMethodOfPayment() }}</p>

        <a href="{{ route('order.delete', ['id' => $order->getId()]) }}"
           class="btn btn-danger">
           Delete Order
        </a>
    </div>
</div>
@endsection