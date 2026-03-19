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

                <td>
                    <a href="{{ route('product.show', $product->getId()) }}"
                       class="btn btn-info btn-sm">
                        Ver
                    </a>

                    <a href="{{ route('product.edit', $product->getId()) }}"
                       class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    @if($showDeleteButton)
                        <form action="{{ route('product.destroy', $product->getId()) }}"
                              method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
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
