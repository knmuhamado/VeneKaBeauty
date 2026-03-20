<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['categories'] = Category::all();

        return view('admin.category.index', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['isEdit'] = false;

        return view('admin.category.create', $viewData);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index')
            ->with('success', 'Categoría creada satisfactoriamente');
    }

    public function edit(int $id): View
    {
        $viewData = [];
        $viewData['category'] = Category::findOrFail($id);
        $viewData['isEdit'] = true;

        return view('admin.category.edit', $viewData);
    }

    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->setName($request->validated()['name']);
        $category->save();

        return redirect()->route('admin.category.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Categoría eliminada correctamente');
    }
}