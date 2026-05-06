<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with('category')
            ->where('available', true)
            ->get()
            ->map(function (Product $product) {
                return [
                    'id'          => $product->getId(),
                    'name'        => $product->getName(),
                    'description' => $product->getDescription(),
                    'price'       => $product->getPrice(),
                    'brand'       => $product->getBrand(),
                    'type'        => $product->getType(),
                    'keywords'    => $product->getKeyword(),
                    'image'       => asset('storage/' . $product->getImage()),
                    'category'    => $product->getCategory()->getName(),
                    'rating'      => $product->getRating(),
                    'url'         => url('/products/' . $product->getId()),
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }
}