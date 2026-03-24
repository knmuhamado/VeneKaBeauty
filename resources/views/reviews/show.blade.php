@extends('layouts.app')

@section('title', __('review.detail_title'))

@section('content')

<h2>{{ __('review.detail_title') }}</h2>

<ul>
    <li><strong>ID:</strong> {{ $viewData['review']->getId() }}</li>
    <li><strong>{{ __('review.comment') }}:</strong> {{ $viewData['review']->getComment() }}</li>
    <li><strong>{{ __('review.score') }}:</strong> {{ $viewData['review']->getScore() }}</li>
    <li><strong>{{ __('review.created_at') }}:</strong> {{ $viewData['review']->getCreatedAt() }}</li>
    <li><strong>{{ __('review.updated_at') }}:</strong> {{ $viewData['review']->getUpdatedAt() }}</li>
</ul>

<br>

@if($viewData['review']->getProductId())
    <a href="{{ route('product.review.index', $viewData['review']->getProductId()) }}" class="btn btn-secondary">
        Volver a reviews del producto
    </a>
@else
    <a href="{{ route('review.index') }}" class="btn btn-secondary">
        Volver a la lista
    </a>
@endif

<form action="{{ route('review.destroy', $viewData['review']->getId()) }}" method="POST" style="margin-top: 15px;">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        Eliminar Review
    </button>
</form>

@endsection