{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h2 class="mb-0">Administrar Categorías</h2>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            Ir a productos
        </a>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
            Crear nueva categoría
        </a>
    </div>
</div>

@include('layouts._success_alert')

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->getId() }}</td>
                <td>{{ $category->getName() }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->getId()) }}" class="btn btn-outline-secondary btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('admin.category.destroy', $category->getId()) }}"
                          method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    No hay categorías registradas
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
