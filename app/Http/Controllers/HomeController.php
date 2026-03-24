<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Services\ProductService;

class HomeController extends Controller
{
    public function __construct(private ProductService $productService) {}

    public function index(Request $request): View
    {
        $viewData = [];

        $query = (string) $request->query('query', '');
        $categoryIds = array_values(
            array_map('intval', array_filter((array) $request->query('category_ids', [])))
        );

        $productQuery = Product::with('category');

        if (!empty($query)) {
            $productQuery->filterByName($query);
        }

        if (!empty($categoryIds)) {
            $productQuery->filterByCategories($categoryIds);
        }

        try {
            $viewData['featuredProducts'] = Product::getTopRatedProducts();
        } catch (QueryException $e) {
            $viewData['featuredProducts'] = collect();
        }

        $viewData['products'] = $productQuery->get();
        $viewData['query'] = $query;
        $viewData['categories'] = $this->productService
            ->prepareCategoriesWithSelection($categoryIds);
        $viewData['selectedCategories'] = $categoryIds;
        $viewData['hasFilters'] = !empty($query) || !empty($categoryIds);

        return view('home.index', $viewData);
    }
}