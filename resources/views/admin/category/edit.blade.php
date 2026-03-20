{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => 'Editar Categoría',
        'action' => route('admin.category.update', $category->getId()),
        'method' => 'PUT',
        'formView' => 'admin.category._form',
        'submitText' => 'Actualizar Categoría',
        'backRoute' => route('admin.category.index'),
        'backText' => 'Cancelar',
    ])
@endsection
