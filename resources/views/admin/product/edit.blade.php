{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
    @include('layouts._crud_form_page', [
        'title' => __('product.edit_title'),
        'action' => route('admin.product.update', $product->getId()),
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'formView' => 'admin.product._form',
        'submitText' => __('product.update_submit'),
        'backRoute' => route('admin.product.index'),
        'backText' => __('product.cancel'),
    ])
@endsection
