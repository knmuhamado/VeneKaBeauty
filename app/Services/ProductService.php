<?php

// David Alejandro Gutiérrez Leal

namespace App\Services;

use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(
        private ImageStorage $imageStorage
    ) {}

    /**
     * Prepare categories with selection status
     */
    public function prepareCategoriesWithSelection(array $selectedIds = []): Collection
    {
        return Category::query()->orderBy('name')->get()->map(function ($category) use ($selectedIds) {
            $category->isSelected = in_array($category->getId(), $selectedIds, true);

            return $category;
        });
    }

    /**
     * Store a new product with image handling
     */
    public function storeProduct(array $validated, ?UploadedFile $image = null): Product
    {
        if ($image) {
            $validated['image'] = $this->imageStorage->store($image);
        }

        return Product::create($validated);
    }

    /**
     * Update an existing product with image handling
     */
    public function updateProduct(Product $product, array $validated, ?UploadedFile $image = null): void
    {
        if ($image) {
            $this->imageStorage->delete($product->getImage());
            $validated['image'] = $this->imageStorage->store($image);
        }

        $product->update($validated);
    }

    /**
     * Delete a product and its image
     */
    public function deleteProduct(Product $product): void
    {
        $this->imageStorage->delete($product->getImage());
        $product->delete();
    }
}
