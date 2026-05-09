<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        try {
            $viewData['featuredProducts'] = Product::getTopRatedProducts();
        } catch (QueryException $e) {
            Log::error('HomeController: getTopRatedProducts failed', ['error' => $e->getMessage()]);

            try {
                $viewData['featuredProducts'] = Product::all();
            } catch (QueryException $e2) {
                Log::error('HomeController: fallback Product::all() failed (db unreachable)', ['error' => $e2->getMessage()]);
                $viewData['featuredProducts'] = collect();
            }
        }

        return view('home.index', $viewData);
    }
}
