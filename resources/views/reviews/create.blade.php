@extends('layouts.app')

@section('title', __('review.create_title'))

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('layouts._crud_form_page', [
    'title' => __('review.create_title'),
    'action' => route('review.store'),
    'method' => 'POST',
    'formView' => 'reviews._form',
    'submitText' => __('review.create_submit'),
    'backRoute' => !empty($viewData['productId']) 
        ? route('product.review.index', $viewData['productId']) 
        : route('home.index'),
    'backText' => __('review.back')
])

@endsection