{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
        <h2 class="mb-0">Lista de Productos</h2>

        <a href="{{ route('product.create') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
            <span>Crear producto</span>
        </a>
    </div>

    @include('layouts._success_alert')

    @include('products._filter')

    @include('products._table', [
        'showDeleteButton' => true,
        'emptyMessage' => 'No hay productos registrados',
    ])
</div>

@endsection