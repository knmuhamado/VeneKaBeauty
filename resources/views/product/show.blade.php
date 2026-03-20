{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<h2>Detalle del Producto</h2>

<div class="card" style="width: 25rem;">
    <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top" alt="{{ $product->getName() }}">

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

        <a href="{{ route('product.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
