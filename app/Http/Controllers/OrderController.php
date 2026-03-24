<?php

// Kadiha Muhamad

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Interfaces\PdfGenerator;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private PdfGenerator $pdfGenerator
    ) {}


    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::where('user_id', auth()->id())->get();

        return view('orders.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $order = Order::findOrFail($id);

        $viewData = [];
        $viewData['order'] = $order;
        $viewData['items'] = $order->getItems();

        return view('orders.show')->with('viewData', $viewData);
    }

    public function delete(string $id): RedirectResponse
    {
        Order::destroy($id);

        return redirect()->route('order.list')
            ->with('success', 'order.deleted_success');
    }

    public function pdf(string $id): Response
    {
        $order  = Order::findOrFail($id);
        $output = $this->pdfGenerator->generateOrderPdf($order);

        return response($output, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="order-'.$order->getId().'.pdf"',
        ]);
    }
}
