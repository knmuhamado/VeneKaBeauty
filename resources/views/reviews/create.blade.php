@extends('layouts.app')

@section('title', 'Crear Review')

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
    'title' => 'Crear Review',
    'action' => route('review.store'),
    'method' => 'POST',
    'formView' => 'reviews._form',
    'submitText' => 'Guardar',
    'backRoute' => !empty($viewData['productId']) 
        ? route('product.review.index', $viewData['productId']) 
        : route('home.index'),
    'backText' => 'Volver'
])

@endsection