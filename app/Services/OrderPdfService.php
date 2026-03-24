<?php

// Kadiha Muhamad

namespace App\Services;

use App\Interfaces\PdfGenerator;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderPdfService implements PdfGenerator
{
    public function generateOrderPdf(Order $order): string
    {
        $pdf = Pdf::loadView('orders.pdf', [
            'order' => $order,
            'items' => $order->getItems(),
        ]);

        return $pdf->output();
    }
}