{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => 'Crear Producto',
        'action' => route('admin.product.store'),
        'enctype' => 'multipart/form-data',
        'formView' => 'admin.product._form',
        'submitText' => 'Crear Producto',
        'backRoute' => route('admin.product.index'),
        'backText' => 'Volver',
    ])
@endsection
