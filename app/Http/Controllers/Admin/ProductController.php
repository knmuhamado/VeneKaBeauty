<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct(
        private ImageStorage $imageStorage
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
        $viewData['categories'] = Category::getWithSelection($categoryIds);
        $viewData['hasFilters'] = ! empty($query) || ! empty($categoryIds);

        return view('admin.product.index', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['isEdit'] = false;
        $viewData['availableDefault'] = '1';
        $viewData['keywordDefault'] = '';
        $viewData['categories'] = Category::all();

        return view('admin.product.create', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $image = $request->file('image');

        if ($image) {
            $validated['image'] = $this->imageStorage->store($image);
        }

        Product::create($validated);

        return redirect()->route('admin.product.index')
            ->with('success', __('product.created_success'));
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

        return view('admin.product.edit', $viewData);
    }

    public function update(StoreProductRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();
        $image = $request->file('image');

        if ($image) {
            $this->imageStorage->delete($product->getImage());
            $validated['image'] = $this->imageStorage->store($image);
        }

        $product->update($validated);

        return redirect()->route('admin.product.index')
            ->with('success', __('product.updated_success'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $this->imageStorage->delete($product->getImage());
        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', __('product.deleted_success'));
    }
}
