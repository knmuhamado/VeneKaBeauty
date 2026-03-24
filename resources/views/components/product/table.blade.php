{{-- David Alejandro Gutiérrez Leal --}}
@props([
    'products' => collect(),
    'emptyMessage' => __('product.empty_default'),
    'showAdminActions' => false,
    'viewRoute' => 'product.show',
    'editRoute' => 'admin.product.edit',
    'deleteRoute' => 'admin.product.destroy',
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
            <th>{{ __('product.rating') }}</th>
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

                <td>{{ $product->getRating() }}</td>

                <td class="text-nowrap">
                    @if($showAdminActions)
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ route($viewRoute, $product->getId()) }}"
                               class="btn btn-primary btn-sm">
                                {{ __('product.view') }}
                            </a>

                            <a href="{{ route($editRoute, $product->getId()) }}"
                               class="btn btn-outline-secondary btn-sm">
                                {{ __('product.edit') }}
                            </a>

                            <form action="{{ route($deleteRoute, $product->getId()) }}"
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
                    @else
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ route($viewRoute, $product->getId()) }}"
                               class="btn btn-primary btn-sm">
                                {{ __('product.view') }}
                            </a>

                            <a href="{{ route('product.review.index', $product->getId()) }}"
                               class="btn btn-outline-primary btn-sm">
                                {{ __('product.view_comments') }}
                            </a>
                        </div>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">
                    {{ $emptyMessage }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>