{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Categoría</h2>

    <form method="POST" action="{{ route('category.update', $category->getId()) }}">
        @csrf
        @method('PUT')

        @include('categories._form')

        @include('layouts._form_actions', [
            'submitText' => 'Actualizar Categoría',
            'backRoute' => route('category.index'),
            'backText' => 'Cancelar',
        ])
    </form>
</div>
@endsection
