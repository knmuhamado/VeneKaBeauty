<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest; //✅
use App\Models\Review; //✅
use Illuminate\Http\RedirectResponse; //✅
use Illuminate\View\View;//✅

//use Illuminate\Http\Request;


class ReviewController extends Controller
{
    //tipo de retorno: View
    public function create(): View
    {
        return view('reviews.create');
    }

    // store() = stores the data entered by the user
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        try {

            Review::create($request->only('comment', 'score'));

            $success = 'Review was created successfully';

            return redirect()->route('home.index')->with('success', $success);

        } catch (\Exception $e) {

            $error = 'Review could not be created';

            return redirect()->route('home.index')->with('error', $error);
        }
    }

    /*
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        Review::create(
            $request->only('comment', 'score')
        );

        return redirect('/')
            ->with('success', 'Review creada correctamente');
    }
     */



    // viewData = crea un arreglo en la que se va almacenar los datos para llevarlos a la vista
    //tipo de retorno: View
    public function index(): View
    {
        $viewData = [];
        $viewData['reviews'] = Review::all();

        return view('reviews.index')->with('viewData', $viewData);
    }

    // show() = shows us the information from a single review
    // viewData = crea un arreglo en la que se va almacenar los datos para llevarlos a la vista
    //tipo de retorno view
    //tipo de dato que recibe el método: int
    public function show(int $id): View
    {
        $viewData = [];
        $viewData['review'] = Review::findOrFail($id);

        return view('reviews.show')->with('viewData', $viewData);
    }

    // destroy() = destroys or deletes a review from the database
    //tipo de retorno RedirectResponse
    //tipo de dato que recibe el método: int
    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')
            ->with('success', 'Review eliminada correctamente');
    }
}
