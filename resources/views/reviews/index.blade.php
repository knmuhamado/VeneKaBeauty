@extends('layouts.app')

@section('title', 'Listar Reviews')

@section('content')

<h2>Lista de Reviews</h2>

{{-- Mensajes de sesión --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
            <th>Comentario</th>
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
            <td>{{ $review->getComment() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
    Volver al inicio
</a>

@endsection