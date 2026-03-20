<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index(SearchProductRequest $request): View
    {
        $validated = $request->validated();
        $query = $validated['query'] ?? '';
        $categoryIds = array_values(array_map('intval', array_filter($validated['category_ids'] ?? [])));

        $productQuery = Product::with('category');

        if (! empty($query)) {
            $productQuery->filterByName($query);
        }

        if (! empty($categoryIds)) {
            $productQuery->filterByCategories($categoryIds);
        }

        $viewData = [];
        $viewData['products'] = $productQuery->get();
        $viewData['query'] = $query;
        $viewData['selectedCategories'] = $categoryIds;
        $viewData['categories'] = $this->productService->prepareCategoriesWithSelection($categoryIds);
        $viewData['hasFilters'] = ! empty($query) || ! empty($categoryIds);

        return view('product.index', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('category')->findOrFail($id);

        return view('product.show', $viewData);
    }
}
