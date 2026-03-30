{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
    <h2 class="mb-0">{{ __('product.admin_manage') }}</h2>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary btn-lg">
            {{ __('product.go_to_categories') }}
        </a>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
            <span>{{ __('product.create') }}</span>
        </a>
    </div>
</div>

@include('layouts._success_alert')

@include('components.product.filter', [
    'actionRoute' => 'admin.product.index',
    'query' => $query,
    'categories' => $categories,
    'hasFilters' => $hasFilters,
    'queryInputId' => 'admin-query',
    'categoryIdPrefix' => 'admin-category',
])

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>{{ __('product.name') }}</th>
            <th>{{ __('product.image') }}</th>
            <th>{{ __('product.price') }}</th>
            <th>{{ __('product.available') }}</th>
            <th>{{ __('product.category') }}</th>
            <th>{{ __('product.type') }}</th>
            <th>{{ __('product.actions') }}</th>
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
                        {{ __('product.not_available') }}
                    @endif
                </td>

                <td>${{ number_format($product->getPrice(), 0, ',', '.') }}</td>

                <td>{{ $product->getAvailable() ? __('product.yes') : __('product.no') }}</td>

                <td>{{ $product->getCategory()?->getName() ?? __('product.not_available') }}</td>

                <td>{{ ucfirst($product->getType()) }}</td>

                <td class="text-nowrap">
                    <div class="d-inline-flex align-items-center gap-2">
                        <a href="{{ route('product.show', $product->getId()) }}"
                           class="btn btn-primary btn-sm">
                            {{ __('product.view') }}
                        </a>

                        <a href="{{ route('admin.product.edit', $product->getId()) }}"
                           class="btn btn-outline-secondary btn-sm">
                            {{ __('product.edit') }}
                        </a>

                        <form action="{{ route('admin.product.destroy', $product->getId()) }}"
                              method="POST"
                              class="d-inline-block m-0">
                            @csrf
                            @method('DELETE')
                            @php($deleteConfirm = __('product.delete_confirm'))

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                    title="{{ __('product.delete_title') }}"
                                    aria-label="{{ __('product.delete_aria') }}"
                                    onclick="return confirm('{{ $deleteConfirm }}')">
                                {{ __('product.delete') }}
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    {{ __('product.empty_registered') }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
