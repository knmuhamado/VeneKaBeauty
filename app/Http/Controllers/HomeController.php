<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        try {
            $viewData['featuredProducts'] = Product::with('category')
                ->latest('created_at')
                ->take(6)
                ->get();
        } catch (QueryException) {
            $viewData['featuredProducts'] = collect();
        }

        return view('home.index', $viewData);
    }
}