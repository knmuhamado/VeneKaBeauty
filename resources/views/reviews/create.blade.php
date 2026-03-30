@extends('layouts.app')

@section('title', __('review.create_title'))

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>{{ __('review.create_title') }}</h2>

<form method="POST" action="{{ route('review.store') }}">
    @csrf

    @include('reviews._form')

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ __('review.create_submit') }}
        </button>

        <a href="{{ !empty($viewData['productId']) ? route('product.show', $viewData['productId']) : route('home.index') }}" class="btn btn-secondary">
            {{ __('review.back') }}
        </a>
    </div>
</form>

@endsection