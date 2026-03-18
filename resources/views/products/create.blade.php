@extends('layouts.app')

@section('content')
{{-- David Alejandro Gutiérrez Leal --}}
<div class="container mt-4">
    <h2>Crear Producto</h2>

    <form method="POST" action="{{ route('product.save') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Imagen</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Disponible</label>
            <select name="available" class="form-control">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Marca (opcional)</label>
            <input type="text" name="brand" class="form-control">
        </div>

        <div class="mb-3">
            <label>Keywords (separadas por coma)</label>
            <input type="text" name="keyword" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <select name="type" class="form-control">
                <option value="article">Artículo</option>
                <option value="service">Servicio</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Crear Producto
        </button>

    </form>
</div>

@endsection