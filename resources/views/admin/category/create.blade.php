{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => __('category.create_title'),
        'action' => route('admin.category.store'),
        'formView' => 'admin.category._form',
        'submitText' => __('category.create_submit'),
        'backRoute' => route('admin.category.index'),
        'backText' => __('category.back'),
    ])
@endsection
