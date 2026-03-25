{{-- Mariamny Del Valle Ramírez Telles --}}
@extends('layouts.app')

@section('title', __('review.edit_title'))

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
    'title' => __('review.edit_title'),
    'action' => route('review.update', $viewData['review']->getId()),
    'method' => 'PUT',
    'formView' => 'reviews._form',
    'submitText' => __('review.update_submit'),
    'backRoute' => route('product.review.index', $viewData['productId']),
    'backText' => __('review.back')
])

@endsection
