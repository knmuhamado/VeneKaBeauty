<?php

// Kadiha Muhamad

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CartConfirmRequest;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart     = $request->session()->get('cart', []);
        $products = empty($cart)
            ? collect()
            : Product::whereIn('id', array_keys($cart))->get();

        $viewData = [];
        $viewData['products'] = $products;
        $viewData['cart']     = $cart;
        $viewData['total']    = $this->calculateTotal($products, $cart);

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(string $id, Request $request): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $cart    = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
                'price'    => $product->getPrice(),
            ];
        }

        $request->session()->put('cart', $cart);

        return back()->with('success', 'cart.added_success');
    }

    public function update(string $id, Request $request): RedirectResponse
    {
        $cart     = $request->session()->get('cart', []);
        $quantity = (int) $request->input('quantity', 1);

        if (isset($cart[$id])) {
            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $quantity;
            }

            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'cart.updated_success');
    }

    public function remove(string $id, Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$id]);

        $request->session()->put('cart', $cart);

        return back()->with('success', 'cart.removed_success');
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return back()->with('success', 'cart.cleared_success');
    }

    public function confirm(CartConfirmRequest $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'cart.empty_cart');
        }

        $order = Order::create([
            'total'             => $this->calculateTotal(collect(), $cart),
            'date'              => now()->toDateString(),
            'paid'              => false,
            'shipped'           => false,
            'method_of_payment' => $request->input('method_of_payment', 'cash'),
            'user_id'           => auth()->id(),
        ]);

        foreach ($cart as $productId => $data) {
            Item::create([
                'quantity'   => $data['quantity'],
                'price'      => $data['price'],
                'product_id' => $productId,
                'order_id'   => $order->getId(),
            ]);
        }

        $request->session()->forget('cart');

        return redirect()->route('order.show', $order->getId())
            ->with('success', 'cart.confirmed_success');
    }

    private function calculateTotal($products, array $cart): int
    {
        if ($products->isEmpty()) {
            return array_sum(
                array_map(fn ($item) => $item['price'] * $item['quantity'], $cart)
            );
        }

        $total = 0;

        foreach ($products as $product) {
            $id = (string) $product->getId();
            if (isset($cart[$id])) {
                $total += $product->getPrice() * $cart[$id]['quantity'];
            }
        }

        return $total;
    }

    public function decrease(string $id, Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] <= 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity']--;
            }

            $request->session()->put('cart', $cart);
        }

        return back()->with('success', 'cart.updated_success');
    }
}