@extends('layouts.app')

@section('title', __('assistant.widget.title'))

@section('content')
@include('components.breadcrumbs', ['breadcrumbs' => [
    ['label' => __('app.home'), 'url' => route('home.index')],
    ['label' => __('assistant.widget.title'), 'url' => '#'],
]])

    <div class="row">
        <div class="col-12">
            @include('assistant.chat')
        </div>
    </div>
@endsection
