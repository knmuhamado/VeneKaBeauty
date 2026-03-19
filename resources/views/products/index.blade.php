{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3">Lista de Productos</h2>

    @include('layouts._success_alert')

    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
        Crear nuevo producto
    </a>

    <form method="GET" action="{{ route('product.search') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar por nombre...">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>

    @include('products._table', [
        'showDeleteButton' => true,
        'emptyMessage' => 'No hay productos registrados',
    ])
</div>

@endsection