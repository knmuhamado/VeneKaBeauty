{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-3">Búsqueda de Productos</h2>

    <form method="GET" action="{{ route('product.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text"
                   name="query"
                   class="form-control @error('query') is-invalid @enderror"
                   placeholder="Buscar por nombre..."
                   value="{{ $query }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
        @error('query')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </form>

    <p>Resultados para: <strong>{{ $query }}</strong></p>

    @include('products._table', [
        'showDeleteButton' => false,
        'emptyMessage' => 'No se encontraron productos con ese nombre',
    ])

    <a href="{{ route('product.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>

@endsection
