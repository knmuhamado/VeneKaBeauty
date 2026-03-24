{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Crear Producto</h2>

    <form method="POST" action="{{ route('product.save') }}" enctype="multipart/form-data">
        @csrf

        @include('products._form')

        @include('layouts._form_actions', [
            'submitText' => 'Crear Producto',
            'backRoute' => route('product.index'),
            'backText' => 'Volver',
        ])

    </form>
</div>

@endsection