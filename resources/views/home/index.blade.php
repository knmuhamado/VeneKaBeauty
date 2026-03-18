@extends('layouts.app')

@section('title', 'Home Reviews')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="text-center mt-5">

    <h2>Bienvenido al sistema de Reviews</h2>

    <br>

    <a href="{{ route('review.create') }}" class="btn btn-primary">
        Crear Review
    </a>

    <a href="{{ route('review.index') }}" class="btn btn-secondary">
        Listar Reviews
    </a>

</div>
@endsection