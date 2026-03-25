<?php

// Kadiha Muhamad

namespace App\Providers;

use App\Interfaces\PdfGenerator;
use App\Services\OrderPdfService;
use Illuminate\Support\ServiceProvider;

class PdfServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PdfGenerator::class, OrderPdfService::class);
    }
}
