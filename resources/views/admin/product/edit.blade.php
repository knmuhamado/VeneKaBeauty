{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => 'Editar Producto',
        'action' => route('admin.product.update', $product->getId()),
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'formView' => 'admin.product._form',
        'submitText' => 'Actualizar Producto',
        'backRoute' => route('admin.product.index'),
        'backText' => 'Cancelar',
    ])
@endsection
