<?php
//Mariamny Del Valle Ramírez Telles

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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

        return redirect('/')
            ->with('success', 'Review creada correctamente');
    }
     

    // viewData = crea un arreglo en la que se va almacenar los datos para llevarlos a la vista
    // tipo de retorno: View
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

    // show() = shows us the information from a single review
    // viewData = crea un arreglo en la que se va almacenar los datos para llevarlos a la vista
    // tipo de retorno view
    // tipo de dato que recibe el método: int
    public function show(int $id): View
    {
        $viewData = [];
        $viewData['review'] = Review::findOrFail($id);

        return view('reviews.show')->with('viewData', $viewData);
    }

    // destroy() = destroys or deletes a review from the database
    // tipo de retorno RedirectResponse
    // tipo de dato que recibe el método: int
    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $productId = $review->getProductId();
        $review->delete();

        if ($productId !== null) {
            return redirect()->route('product.review.index', $productId)
                ->with('success', 'Review eliminada correctamente');
        }

        return redirect()->route('review.index')
            ->with('success', 'Review eliminada correctamente');
    }
}
