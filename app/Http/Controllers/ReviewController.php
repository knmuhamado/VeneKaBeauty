<?php

// Mariamny Del Valle Ramírez Telles

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function create(Request $request): View
    {
        $viewData = [];
        $viewData['productId'] = $request->integer('product_id') ?: null;

        return view('reviews.create')->with('viewData', $viewData);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        Review::create([
            'comment' => $request->comment,
            'score' => $request->score,
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('product.index')
            ->with('success', __('review.created_success'));
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['reviews'] = Review::with(['product', 'user'])->get();
        $viewData['product'] = null;

        return view('reviews.index')->with('viewData', $viewData);
    }

    public function productReviews(int $productId): View
    {
        $product = Product::findOrFail($productId);

        $viewData = [];
        $viewData['product'] = $product;
        $viewData['reviews'] = Review::with(['product', 'user'])
            ->where('product_id', $productId)
            ->get();

        return view('reviews.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['review'] = Review::findOrFail($id);

        return view('reviews.show')->with('viewData', $viewData);
    }

    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $productId = $review->getProductId();
        $review->delete();

        if ($productId !== null) {
            return redirect()->route('product.review.index', $productId)
                ->with('success', __('review.deleted_success'));
        }

        return redirect()->route('review.index')
            ->with('success', 'Review eliminada correctamente');
    }
}
