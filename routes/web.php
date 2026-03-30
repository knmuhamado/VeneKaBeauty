<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/reviews/store', 'App\Http\Controllers\ReviewController@store')->name('review.store');
Route::delete('/reviews/destroy/{id}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');

Route::get('/orders/list', 'App\Http\Controllers\OrderController@index')->name('order.list');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
Route::get('/orders/delete/{id}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');
Route::get('/orders/{id}/pdf', 'App\Http\Controllers\OrderController@pdf')->name('order.pdf');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::get('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/update/{id}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::get('/cart/remove/{id}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::get('/cart/decrease/{id}', 'App\Http\Controllers\CartController@decrease')->name('cart.decrease');
Route::get('/cart/removeAll', 'App\Http\Controllers\CartController@removeAll')->name('cart.removeAll');
Route::post('/cart/confirm', 'App\Http\Controllers\CartController@confirm')->name('cart.confirm')->middleware('auth');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::get('/products/{productId}/reviews', 'App\Http\Controllers\ReviewController@productReviews')->name('product.review.index');

// Protected Admin Routes
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/products', 'App\Http\Controllers\Admin\ProductController@index')->name('admin.product.index');
    Route::get('/admin/products/create', 'App\Http\Controllers\Admin\ProductController@create')->name('admin.product.create');
    Route::post('/admin/products', 'App\Http\Controllers\Admin\ProductController@store')->name('admin.product.store');
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('admin.product.edit');
    Route::put('/admin/products/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('admin.product.update');
    Route::delete('/admin/products/{id}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('admin.product.destroy');

    Route::get('/admin/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('admin.category.index');
    Route::get('/admin/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('admin.category.create');
    Route::post('/admin/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('admin.category.store');
    Route::get('/admin/categories/{id}/edit', 'App\Http\Controllers\Admin\CategoryController@edit')->name('admin.category.edit');
    Route::put('/admin/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('admin.category.update');
    Route::delete('/admin/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('admin.category.destroy');

});

// Review actions for logged-in users
Route::middleware(['auth'])->group(function () {

    Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
    Route::post('/reviews/store', 'App\Http\Controllers\ReviewController@store')->name('review.store');
    Route::get('/reviews/{id}/edit', 'App\Http\Controllers\ReviewController@edit')->name('review.edit');
    Route::put('/reviews/{id}', 'App\Http\Controllers\ReviewController@update')->name('review.update');

});

Auth::routes();
