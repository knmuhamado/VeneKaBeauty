{{-- Edit Review View --}}
@extends('layouts.app')

@section('title', __('review.edit_title'))

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

<h2>{{ __('review.edit_title') }}</h2>

<form method="POST" action="{{ route('review.update', $viewData['review']->getId()) }}">
    @csrf
    @method('PUT')

    @include('reviews._form')

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ __('review.update_submit') }}
        </button>

        <a href="{{ route('product.show', $viewData['productId']) }}" class="btn btn-secondary">
            {{ __('review.back') }}
        </a>
    </div>
</form>

@endsection
