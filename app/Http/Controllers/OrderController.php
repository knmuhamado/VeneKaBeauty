<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function home(): View
    {
        return view('order.home');
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::all();

        return view('order.index')->with('viewData', $viewData);
    }
    public function show(string $id): View
    {
        $viewData = [];
        $order = Order::findOrFail($id);
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return view('order.create');
    }
    public function save(OrderRequest $request): RedirectResponse
    {
        Order::create($request->validated());

        return redirect()->route('order.list')
            ->with('success', 'Order created successfully.');

    }

    public function delete(string $id): RedirectResponse
    {
        Order::destroy($id);

        return redirect()->route('order.list');
    }
}
