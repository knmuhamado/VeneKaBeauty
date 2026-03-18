@extends('layouts.app')
@section('title', "Orders")
@section('subtitle', "List of orders")
@section('content')
<div class="row">
  @foreach ($viewData["orders"] as $order)
  <div class="col-md-4 col-lg-3 mb-2">
    <div class="card">
      <img src="https://laravel.com/img/logotype.min.svg" class="card-img-top img-card">
      <div class="card-body text-center">
        <a href="{{ route('order.show', ['id'=> $order->getId()]) }}"
        class="btn btn-lila text-white">
        Order #{{ $order->getId() }}
        </a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
