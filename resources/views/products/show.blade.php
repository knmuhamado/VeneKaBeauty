{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Detalle del Producto</h2>

    <div class="card" style="width: 25rem;">
        <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top">

        <div class="card-body">
            <h5 class="card-title">{{ $product->getName() }}</h5>
            <p class="card-text">{{ $product->getDescription() }}</p>

            <p><strong>Precio:</strong> ${{ $product->getPrice() }}</p>
            <p><strong>Disponible:</strong> {{ $product->getAvailable() ? 'Sí' : 'No' }}</p>
            <p><strong>Marca:</strong> {{ $product->getBrand() ?? 'N/A' }}</p>
            <p><strong>Categoría:</strong> {{ $product->getCategory()?->getName() ?? 'N/A' }}</p>
            <p><strong>Tipo:</strong> {{ $product->getType() }}</p>

            <p><strong>Keywords:</strong>
                @if($product->getKeyword())
                    {{ implode(', ', $product->getKeyword()) }}
                @else
                    N/A
                @endif
            </p>

            @include('layouts._link_actions', [
                'primaryRoute' => route('product.edit', $product->getId()),
                'primaryText' => 'Editar',
                'secondaryRoute' => route('product.index'),
                'secondaryText' => 'Volver',
            ])
        </div>
    </div>
</div>

@endsection