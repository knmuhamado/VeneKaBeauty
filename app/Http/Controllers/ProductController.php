<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::with('category')->get();
        $viewData['categories'] = $this->productService->prepareCategoriesWithSelection();
        $viewData['query'] = '';
        $viewData['selectedCategories'] = [];
        $viewData['hasFilters'] = false;

        return view('products.index', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::with('category')->findOrFail($id);

        return view('products.show', $viewData);
    }

    public function search(SearchProductRequest $request): View
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

        return view('products.search', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['isEdit'] = false;
        $viewData['availableDefault'] = '1';
        $viewData['keywordDefault'] = '';
        $viewData['categories'] = Category::all();

        return view('products.create', $viewData);
    }

    public function save(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->productService->storeProduct($validated, $request->file('image'));

        return redirect()->route('product.index')
            ->with('success', 'Elemento creado satisfactoriamente');
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);
        $viewData = [];
        $viewData['product'] = $product;
        $viewData['isEdit'] = true;
        $viewData['availableDefault'] = (string) (int) $product->getAvailable();
        $viewData['keywordDefault'] = implode(', ', $product->getKeyword());
        $viewData['categories'] = Category::all();

        return view('products.edit', $viewData);
    }

    public function update(StoreProductRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();

        $this->productService->updateProduct($product, $validated, $request->file('image'));

        return redirect()->route('product.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $this->productService->deleteProduct($product);

        return redirect()->route('product.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
