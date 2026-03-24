{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('title', __('review.title_list'))

@section('content')

<h2>
    @if(!empty($viewData['product']))
        {{ __('review.title_product') }} {{ $viewData['product']->getName() }}
    @else
        {{ __('review.title_list') }}
    @endif
</h2>

{{-- Mensajes de sesión --}}
@include('layouts._success_alert')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Verificar si existen reviews --}}
@if(count($viewData['reviews']) > 0)

<table class="table">
    <thead>
        <tr>
            <th>{{ __('review.id') }}</th>
            <th>{{ __('review.user') }}</th>
            <th>{{ __('review.comment') }}</th>
            <th>{{ __('review.score') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($viewData['reviews'] as $review)
        <tr>
            <td>
                <a href="{{ route('review.show', $review->getId()) }}">
                    {{ $review->getId() }}
                </a>
            </td>
            <td>{{ $review->user?->getName() ?? __('review.anonymous') }}</td>
            <td>{{ $review->getComment() }}</td>
            <td>{{ $review->getScore() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
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
    <a href="{{ route('review.create', ['product_id' => $viewData['product']->getId()]) }}" class="btn btn-success mt-3">
        {{ __('review.create') }}
    </a>
@endif

<a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
    {{ __('review.back_home') }}
</a>

@endsection