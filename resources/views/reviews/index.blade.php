{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('title', 'Listar Reviews')

@section('content')

<h2>
    @if(!empty($viewData['product']))
        Reviews de: {{ $viewData['product']->getName() }}
    @else
        Lista de Reviews
    @endif
</h2>

{{-- Mensajes de sesión --}}
@include('layouts._success_alert')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Verificar si existen reviews --}}
@if(count($viewData['reviews']) > 0)

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Comentario</th>
            <th>Puntaje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($viewData['reviews'] as $review)
        <tr>
            <td>
                <!-- An object's ID is connected to display its information. -->
                <a href="{{ route('review.show', $review->getId()) }}">
                    {{ $review->getId() }}
                </a>
            </td>
            <td>{{ $review->user?->getName() ?? 'Anónimo' }}</td>
            <td>{{ $review->getComment() }}</td>
            <td>{{ $review->getScore() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>
    @if(!empty($viewData['product']))
        No hay reviews para este producto.
    @else
        No hay reviews registradas.
    @endif
</p>
@endif

@if(!empty($viewData['product']))
    <a href="{{ route('review.create', ['product_id' => $viewData['product']->getId()]) }}" class="btn btn-success mt-3">
        Crear review para este producto
    </a>
@endif

<a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
    Volver al inicio
</a>

@endsection