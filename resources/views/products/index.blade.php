@extends('layouts.app')

@section('content')
{{-- David Alejandro Gutiérrez Leal --}}
<div class="container mt-4">
    <h2 class="mb-3">Lista de Productos</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
        Crear nuevo producto
    </a>

    <form method="GET" action="{{ route('product.search') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar por nombre...">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
    </form>

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

                    <td>
                        {{ $product->getAvailable() ? 'Sí' : 'No' }}
                    </td>

                    <td>{{ ucfirst($product->getType()) }}</td>

                    <td>
                        <a href="{{ route('product.show', $product->getId()) }}" 
                           class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <form action="{{ route('product.destroy', $product->getId()) }}" 
                              method="POST" 
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No hay productos registrados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection