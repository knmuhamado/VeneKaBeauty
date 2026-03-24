{{-- Kadiha Muhamad --}}
@extends('layouts.app')

@section('title', __('cart.title'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{ __('cart.title') }}</h2>

    @include('layouts._success_alert')

    @if(empty($viewData['cart']))
        <div class="alert alert-info">{{ __('cart.empty_registered') }}</div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('cart.product') }}</th>
                    <th>{{ __('cart.unit_price') }}</th>
                    <th>{{ __('cart.quantity') }}</th>
                    <th>{{ __('cart.subtotal') }}</th>
                    <th>{{ __('cart.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['products'] as $product)
                    @php $cartItem = $viewData['cart'][(string) $product->getId()]; @endphp
                    <tr>
                        <td>{{ $product->getName() }}</td>

                        <td data-price="{{ $product->getPrice() }}">
                            $ {{ number_format($product->getPrice(), 0, ',', '.') }}
                        </td>

                        <td>
                            <form action="{{ route('cart.update', $product->getId()) }}"
                                  method="POST"
                                  class="d-flex gap-2 align-items-center">
                                @csrf
                                <input type="number"
                                       name="quantity"
                                       value="{{ $cartItem['quantity'] }}"
                                       min="1"
                                       class="form-control form-control-sm"
                                       style="width: 75px;">
                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                    ↺
                                </button>
                            </form>
                        </td>

                        <td data-subtotal>
                            $ {{ number_format($product->getPrice() * $cartItem['quantity'], 0, ',', '.') }}
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('cart.decrease', $product->getId()) }}"
                                   class="btn btn-outline-danger btn-sm fw-bold"
                                   style="width: 32px;">−</a>

                                <a href="{{ route('cart.remove', $product->getId()) }}"
                                   class="btn btn-danger btn-sm">
                                    {{ __('cart.remove') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">{{ __('cart.total') }}:</td>
                    <td colspan="2" class="fw-bold">
                        $ {{ number_format($viewData['total'], 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex gap-3 mt-3 align-items-center flex-wrap">
            <a href="{{ route('cart.removeAll') }}" class="btn btn-outline-danger">
                {{ __('cart.clear_cart') }}
            </a>

            <form action="{{ route('cart.confirm') }}"
                  method="POST"
                  class="d-flex gap-2 align-items-center">
                @csrf
                <select name="method_of_payment" class="form-select w-auto">
                    <option value="cash">{{ __('order.payment_cash') }}</option>
                    <option value="card">{{ __('order.payment_card') }}</option>
                    <option value="bank">{{ __('order.payment_bank') }}</option>
                </select>
                <button type="submit" class="btn btn-success">
                    {{ __('cart.confirm_order') }}
                </button>
            </form>
        </div>
    @endif

    <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
        {{ __('cart.back') }}
    </a>
</div>

@push('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush

@endsection