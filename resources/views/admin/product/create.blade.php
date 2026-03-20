{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => __('product.create_title'),
        'action' => route('admin.product.store'),
        'enctype' => 'multipart/form-data',
        'formView' => 'admin.product._form',
        'submitText' => __('product.create_submit'),
        'backRoute' => route('admin.product.index'),
        'backText' => __('product.back'),
    ])
@endsection
