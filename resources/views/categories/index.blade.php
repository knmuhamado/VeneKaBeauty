{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Lista de Categorías</h2>

    @include('layouts._success_alert')

    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">
        Crear nueva categoría
    </a>

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
                        <a href="{{ route('category.show', $category->getId()) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('category.edit', $category->getId()) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('category.destroy', $category->getId()) }}"
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
</div>
@endsection
