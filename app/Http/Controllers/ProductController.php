<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

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

    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::with('category')->get();

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
        $query = $request->validated()['query'];

        $viewData = [];
        $viewData['products'] = Product::with('category')->filterByName($query)->get();
        $viewData['query'] = $query;

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
        $validated['image'] = $this->imageStorage->store($request->file('image'));

        Product::create($validated);

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

        if ($request->hasFile('image')) {
            $this->imageStorage->delete($product->getImage());
            $product->setImage($this->imageStorage->store($request->file('image')));
        }

        $product->setName($validated['name'])
            ->setDescription($validated['description'])
            ->setAvailable((bool) $validated['available'])
            ->setPrice((int) $validated['price'])
            ->setBrand($validated['brand'] ?? null)
            ->setKeyword($validated['keyword'] ?? [])
            ->setType($validated['type'])
            ->setCategoryId((int) $validated['category_id']);

        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Producto actualizado correctamente');
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
