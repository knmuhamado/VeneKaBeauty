<?php

// David Alejandro Gutiérrez Leal

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
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

        $cart = (array) $request->session()->get('cart', []);
        $cartQuantities = [];

        foreach ($cart as $productId => $item) {
            $cartQuantities[(int) $productId] = (int) ($item['quantity'] ?? 0);
        }

        $viewData['cartQuantities'] = $cartQuantities;
        /** @var User|null $authUser */
        $authUser = Auth::user();

        $viewData['isLoggedIn'] = $authUser !== null;
        $viewData['canBuy'] = $authUser?->isClient() ?? false;

        return view('product.index', $viewData);
    }

    public function show(int $id): View
    {
        /** @var User|null $authUser */
        $authUser = Auth::user();

        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);
        $reviews = $product->reviews;
        $userReview = null;

        if ($authUser !== null) {
            $userReview = $reviews->firstWhere('user_id', $authUser->getId());
        }

        $viewData = [];
        $viewData['product'] = $product;
        $viewData['reviews'] = $reviews;
        $viewData['userReview'] = $userReview;
        $viewData['canReview'] = $authUser?->isClient() ?? false;
        $viewData['isLoggedIn'] = $authUser !== null;

        return view('product.show', $viewData);
    }
}
