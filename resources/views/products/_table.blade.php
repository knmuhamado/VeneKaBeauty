{{-- David Alejandro Gutiérrez Leal --}}
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
                    <div class="d-inline-flex align-items-center gap-2">
                        <a href="{{ route('product.show', $product->getId()) }}"
                           class="btn btn-primary btn-sm">
                            Ver
                        </a>

                        <a href="{{ route('product.edit', $product->getId()) }}"
                           class="btn btn-outline-secondary btn-sm">
                            Editar
                        </a>

                        @if($showDeleteButton)
                            <form action="{{ route('product.destroy', $product->getId()) }}"
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
                        @endif
                    </div>
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
