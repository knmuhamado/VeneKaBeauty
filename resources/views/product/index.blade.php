{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<h2 class="mb-3">{{ __('product.title') }}</h2>

<x-product.filter
    action-route="product.index"
    :query="$query"
    :categories="$categories"
    :has-filters="$hasFilters"
/>

<x-product.table
    :products="$products"
    :empty-message="__('product.empty_not_found')"
/>
@endsection
