{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<section class="mb-4">
    <h2 class="mb-2">
        @auth
            {{ __('user.welcome_user', ['name' => Auth::user()->getName()]) }}
        @else
            {{ __('user.welcome_guest') }}
        @endauth
    </h2>
    <p class="text-muted mb-3">
        {{ __('product.home_description') }}
    </p>
</section>

<section>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">{{ __('product.home_top') }}</h3>
        <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-primary">{{ __('product.home_view_catalog') }}</a>
    </div>

    <x-product.table
        :products="$featuredProducts"
        empty-message="{{ __('product.home_empty_featured') }}"
    />
</section>
@endsection