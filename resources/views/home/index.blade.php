{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<section class="mb-4">
    <h2 class="mb-2">Bienvenido a VeneKa Beauty</h2>
    <p class="text-muted mb-3">
        Descubre productos de belleza seleccionados para ti. Desde aquí puedes explorar el catálogo público
        o gestionar el contenido desde el panel administrativo.
    </p>
</section>

<section>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">Productos recientes</h3>
        <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-primary">Ver catálogo completo</a>
    </div>

    <x-product.table
        :products="$featuredProducts"
        empty-message="Aún no hay productos destacados disponibles."
    />
</section>
@endsection