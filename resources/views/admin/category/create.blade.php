{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => 'Crear Categoría',
        'action' => route('admin.category.store'),
        'formView' => 'admin.category._form',
        'submitText' => 'Crear Categoría',
        'backRoute' => route('admin.category.index'),
        'backText' => 'Volver',
    ])
@endsection
