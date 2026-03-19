{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detalle de la Categoría</h2>

    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $category->getName() }}</h5>

            <p><strong>ID:</strong> {{ $category->getId() }}</p>
            <p><strong>Nombre:</strong> {{ $category->getName() }}</p>

            @include('layouts._link_actions', [
                'primaryRoute' => route('category.edit', $category->getId()),
                'primaryText' => 'Editar',
                'secondaryRoute' => route('category.index'),
                'secondaryText' => 'Volver',
            ])
        </div>
    </div>
</div>
@endsection
