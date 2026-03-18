@extends('layouts.app')

@section('content')
{{-- David Alejandro Gutiérrez Leal --}}
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

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Disponible</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->getName() }}</td>

                    <td>
                        @if($product->getImage())
                            <img src="{{ asset('storage/' . $product->getImage()) }}"
                                 width="80"
                                 class="img-thumbnail">
                        @else
                            N/A
                        @endif
                    </td>

                    <td>${{ number_format($product->getPrice(), 0, ',', '.') }}</td>

                    <td>{{ $product->getAvailable() ? 'Sí' : 'No' }}</td>

                    <td>{{ ucfirst($product->getType()) }}</td>

                    <td>
                        <a href="{{ route('product.show', $product->getId()) }}"
                           class="btn btn-info btn-sm">
                            Ver
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No se encontraron productos con ese nombre
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('product.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>

@endsection
