@extends('layouts.app')

@section('title', 'Crear Review')

@section('content')

<h2>Crear Review</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('review.store') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label class="form-label">Comentario</label>
        <textarea class="form-control" name="comment">{{ old('comment') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Puntaje - (Desde 0 al 5 - Siendo el 0 la puntuación más baja y el 5 la más alta)</label>
        <input type="number" name="score" min="0" max="5" step="1" class="form-control" value="{{ old('score') }}">
    </div>

   <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">
            Guardar
        </button>

        <a href="{{ route('home.index') }}" class="btn btn-secondary">
            Volver al inicio
        </a>
    </div>
</form>

@endsection