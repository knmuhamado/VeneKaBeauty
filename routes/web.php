<?php

use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// Review Routes
Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/reviews/store', 'App\Http\Controllers\ReviewController@store')->name('review.store');
Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')->name('review.show');
Route::delete('/reviews/destroy/{id}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');

// Order Routes
Route::get('/home', 'App\Http\Controllers\OrderController@home');
Route::get('/orders', 'App\Http\Controllers\OrderController@home')->name('order.home');
Route::get('/orders/list', 'App\Http\Controllers\OrderController@index')->name('order.list');
Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
Route::post('/orders/save', 'App\Http\Controllers\OrderController@save')->name('order.save');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
Route::get('/orders/delete/{id}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');

// User Product Routes
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// Admin Routes
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
