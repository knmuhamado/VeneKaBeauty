{{-- Kadiha Muhamad --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        h1   { font-size: 20px; margin-bottom: 4px; }
        p    { margin: 2px 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4a4a8a;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td   { padding: 7px 8px; border-bottom: 1px solid #ddd; }
        .total-row td { font-weight: bold; background-color: #f0f0f0; }
        .footer { margin-top: 30px; font-size: 11px; color: #888; text-align: center; }
    </style>
</head>
<body>

    <h1>{{ __('order.order_number') }}{{ $order->getId() }}</h1>
    <p><strong>{{ __('order.date') }}:</strong> {{ $order->getDate() }}</p>
    <p><strong>{{ __('order.method_of_payment') }}:</strong> {{ __('order.payment_' . $order->getMethodOfPayment()) }}</p>
    <p><strong>{{ __('order.paid') }}:</strong> {{ $order->getPaid() ? __('order.paid_yes') : __('order.paid_no') }}</p>
    <p><strong>{{ __('order.shipped') }}:</strong> {{ $order->getShipped() ? __('order.shipped_yes') : __('order.shipped_no') }}</p>

    <table>
        <thead>
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
        <tfoot>
            <tr class="total-row">
                <td colspan="3">{{ __('order.total') }}</td>
                <td>$ {{ number_format($order->getTotal(), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        VeneKa Beauty — {{ date('Y') }}
    </div>

</body>
</html>