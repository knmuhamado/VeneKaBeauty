<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Interfaces\ImageStorage;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct(
        private ImageStorage $imageStorage
    ) {}

    public function home(): View
    {
        return view('products.home');
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::all();

        return view('products.index', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::findOrFail($id);

        return view('products.show', $viewData);
    }

    public function search(SearchProductRequest $request): View
    {
        $query = $request->validated()['query'];

        $viewData = [];
        $viewData['products'] = Product::filterByName($query)->get();
        $viewData['query'] = $query;

        return view('products.search', $viewData);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function save(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['image'] = $this->imageStorage->store($request->file('image'));

        Product::create($validated);

        return redirect()->route('product.index')
            ->with('success', 'Elemento creado satisfactoriamente');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $this->imageStorage->delete($product->getImage());

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
