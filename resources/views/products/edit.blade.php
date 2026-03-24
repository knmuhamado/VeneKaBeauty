{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Editar Producto</h2>

    <form method="POST" action="{{ route('product.update', $product->getId()) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('products._form')

        @include('layouts._form_actions', [
            'submitText' => 'Actualizar Producto',
            'backRoute' => route('product.index'),
            'backText' => 'Cancelar',
        ])
    </form>
</div>

@endsection
