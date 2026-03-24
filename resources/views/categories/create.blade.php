{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Crear Categoría</h2>

    <form method="POST" action="{{ route('category.save') }}">
        @csrf

        @include('categories._form')

        @include('layouts._form_actions', [
            'submitText' => 'Crear Categoría',
            'backRoute' => route('category.index'),
            'backText' => 'Volver',
        ])
    </form>
</div>
@endsection
