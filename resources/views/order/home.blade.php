@extends('layouts.app')
@section('content')
<div class="text-center mt-5">
    <h2 class="mb-4 fw-bold">Orders</h2>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('order.create') }}" 
           class="btn btn-lila btn-lg">
            Create new order
        </a>
        <a href="{{ route('order.list') }}" 
           class="btn btn-lila btn-lg">
            View list
        </a>
    </div>
</div>
@endsection