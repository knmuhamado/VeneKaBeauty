{{-- Kadiha Muhamad --}}
<div class="card mb-4">
    <div class="card-header">
        <h5>{{ __('item.title') }}</h5>
    </div>
    <div class="card-body">
        @if($items->isEmpty())
            <p class="text-muted">{{ __('item.empty_registered') }}</p>
        @else
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('item.product') }}</th>
                        <th>{{ __('item.unit_price') }}</th>
                        <th>{{ __('item.quantity') }}</th>
                        <th>{{ __('item.subtotal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->getProduct()->getName() }}</td>
                            <td>$ {{ number_format($item->getPrice(), 0, ',', '.') }}</td>
                            <td>{{ $item->getQuantity() }}</td>
                            <td>$ {{ number_format($item->getPrice() * $item->getQuantity(), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>