{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => __('category.edit_title'),
        'action' => route('admin.category.update', $category->getId()),
        'method' => 'PUT',
        'formView' => 'admin.category._form',
        'submitText' => __('category.update_submit'),
        'backRoute' => route('admin.category.index'),
        'backText' => __('category.cancel'),
    ])
@endsection
