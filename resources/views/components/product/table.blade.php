{{-- David Alejandro Gutiérrez Leal --}}
@props([
    'products' => collect(),
    'emptyMessage' => 'No hay productos',
    'showAdminActions' => false,
    'viewRoute' => 'product.show',
    'editRoute' => 'admin.product.edit',
    'deleteRoute' => 'admin.product.destroy',
])

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Disponible</th>
            <th>Categoría</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->getName() }}</td>

                <td>
                    @if($product->getImage())
                        <img src="{{ asset('storage/' . $product->getImage()) }}"
                             width="80"
                             class="img-thumbnail">
                    @else
                        N/A
                    @endif
                </td>

                <td>${{ number_format($product->getPrice(), 0, ',', '.') }}</td>

                <td>{{ $product->getAvailable() ? 'Sí' : 'No' }}</td>

                <td>{{ $product->getCategory()?->getName() ?? 'N/A' }}</td>

                <td>{{ ucfirst($product->getType()) }}</td>

                <td class="text-nowrap">
                    @if($showAdminActions)
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ route($viewRoute, $product->getId()) }}"
                               class="btn btn-primary btn-sm">
                                Ver
                            </a>

                            <a href="{{ route($editRoute, $product->getId()) }}"
                               class="btn btn-outline-secondary btn-sm">
                                Editar
                            </a>

                            <form action="{{ route($deleteRoute, $product->getId()) }}"
                                  method="POST"
                                  class="d-inline-block m-0">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                        title="Eliminar producto"
                                        aria-label="Eliminar producto"
                                        onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route($viewRoute, $product->getId()) }}"
                           class="btn btn-primary btn-sm">
                            Ver
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    {{ $emptyMessage }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>