{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<h2 class="mb-3">Productos</h2>

<x-product.filter
    action-route="product.index"
    :query="$query"
    :categories="$categories"
    :has-filters="$hasFilters"
/>

<x-product.table
    :products="$products"
    empty-message="No se encontraron productos"
/>
@endsection
