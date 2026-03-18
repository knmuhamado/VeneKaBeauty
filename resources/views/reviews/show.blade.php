@extends('layouts.app')

@section('title', 'Detalle Review')

@section('content')

<h2>Detalle de la Review</h2>

<ul>
    <li><strong>ID:</strong> {{ $viewData['review']->getId() }}</li>
    <li><strong>Comentario:</strong> {{ $viewData['review']->getComment() }}</li>
    <li><strong>Puntaje:</strong> {{ $viewData['review']->getScore() }}</li>
    <li><strong>Creado:</strong> {{ $viewData['review']->created_at }}</li>
    <li><strong>Actualizado:</strong> {{ $viewData['review']->updated_at }}</li>
</ul>

<br>

<a href="{{ route('review.index') }}" class="btn btn-secondary">
    Volver a la lista
</a>

<form action="{{ route('review.destroy', $viewData['review']->getId()) }}" method="POST" style="margin-top: 15px;">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        Eliminar Review
    </button>
</form>

@endsection