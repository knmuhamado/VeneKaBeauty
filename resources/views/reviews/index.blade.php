{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('title', __('review.title_list'))

@section('content')

<h2 class="mb-3">
    @if(!empty($viewData['product']))
        {{ __('review.title_product') }} {{ $viewData['product']->getName() }}
    @else
        {{ __('review.title_list') }}
    @endif
</h2>

@include('layouts._success_alert')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(count($viewData['reviews']) > 0)
<div class="row row-cols-1 row-cols-md-2 g-3">
    @foreach($viewData['reviews'] as $review)
        <div class="col">
            <article class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="mb-0">{{ $review->getUser()?->getName() ?? __('review.anonymous') }}</h6>
                        <span class="badge bg-primary">{{ $review->getScore() }}/5</span>
                    </div>

                    <p class="mb-2">{{ $review->getComment() }}</p>
                    <small class="text-muted mt-auto">#{{ $review->getId() }}</small>
                </div>
            </article>
        </div>
    @endforeach
</div>
@else
<p>
    @if(!empty($viewData['product']))
        {{ __('review.empty_product') }}
    @else
        {{ __('review.empty_all') }}
    @endif
</p>
@endif

@if(!empty($viewData['product']))
    @auth
        @if(!empty($viewData['userReview']))
            <a href="{{ route('review.edit', $viewData['userReview']->getId()) }}" class="btn btn-warning mt-3">
                {{ __('review.edit') }}
            </a>
        @else
            <a href="{{ route('review.create', ['product_id' => $viewData['product']->getId()]) }}" class="btn btn-success mt-3">
                {{ __('review.create') }}
            </a>
        @endif
    @else
        <a href="{{ route('review.create', ['product_id' => $viewData['product']->getId()]) }}" class="btn btn-success mt-3">
            {{ __('review.create') }}
        </a>
    @endauth
@endif

<a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
    {{ __('review.back_home') }}
</a>

@endsection