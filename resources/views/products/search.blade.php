{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3">Productos</h2>

    @include('products._filter')

    @include('products._table', [
        'showDeleteButton' => false,
        'emptyMessage' => 'No se encontraron productos',
    ])
</div>

@endsection
