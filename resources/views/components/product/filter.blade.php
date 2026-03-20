{{-- David Alejandro Gutiérrez Leal --}}
@props([
    'actionRoute',
    'query' => '',
    'categories' => collect(),
    'hasFilters' => false,
    'queryInputId' => 'query',
    'categoryIdPrefix' => 'category',
    'searchPlaceholder' => 'Buscar productos...',
    'clearRoute' => null,
])

<form method="GET" action="{{ route($actionRoute) }}" class="mb-2">
    <div class="border rounded-3 p-3">
        <div class="row g-2 align-items-end">
            <div class="col-lg-5">
                <label for="{{ $queryInputId }}" class="form-label mb-1">Buscar</label>
                <input type="text"
                       id="{{ $queryInputId }}"
                       name="query"
                       class="form-control @error('query') is-invalid @enderror"
                       placeholder="{{ $searchPlaceholder }}"
                       value="{{ old('query', $query) }}">
                @error('query')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4">
                <label class="form-label mb-1">Categorías</label>

                <div class="dropdown w-100" data-bs-auto-close="outside">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Seleccionar categorías
                    </button>

                    <div class="dropdown-menu w-100 p-2 product-filter-menu">
                        @forelse($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="category_ids[]"
                                       value="{{ $category->getId() }}"
                                       id="{{ $categoryIdPrefix }}-{{ $category->getId() }}"
                                    {{ ($category->isSelected ?? false) ? 'checked' : '' }}>

                                <label class="form-check-label text-capitalize" for="{{ $categoryIdPrefix }}-{{ $category->getId() }}">
                                    {{ $category->getName() }}
                                </label>
                            </div>
                        @empty
                            <span class="text-muted small">No hay categorías disponibles</span>
                        @endforelse
                    </div>
                </div>

                @error('category_ids')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">Buscar</button>
                    @if($hasFilters)
                        <a href="{{ route($clearRoute ?? $actionRoute) }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>