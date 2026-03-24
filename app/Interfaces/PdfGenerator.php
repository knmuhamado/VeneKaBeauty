<?php

// Kadiha Muhamad   

namespace App\Interfaces;

use App\Models\Order;

interface PdfGenerator
{
    public function generateOrderPdf(Order $order): string;
}