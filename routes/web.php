<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/reviews/store', 'App\Http\Controllers\ReviewController@store')->name('review.store');
Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')->name('review.show');
Route::delete('/reviews/destroy/{id}', 'App\Http\Controllers\ReviewController@destroy')->name('review.destroy');

Route::get('/home', 'App\Http\Controllers\OrderController@home');
Route::get('/orders', 'App\Http\Controllers\OrderController@home')->name('order.home');
Route::get('/orders/list', 'App\Http\Controllers\OrderController@index')->name('order.list');
Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
Route::post('/orders/save', 'App\Http\Controllers\OrderController@save')->name('order.save');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
Route::get('/orders/delete/{id}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');

// Product Routes
Route::get('/products', 'App\Http\Controllers\ProductController@'.'index')->name('product.index');
Route::get('/products/search', 'App\Http\Controllers\ProductController@search')->name('product.search');
Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::post('/products/save', 'App\Http\Controllers\ProductController@save')->name('product.save');
Route::get('/products/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update')->name('product.update');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');

// Category Routes
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');
Route::post('/categories/save', 'App\Http\Controllers\CategoryController@save')->name('category.save');
Route::get('/categories/{id}/edit', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');
Route::put('/categories/{id}', 'App\Http\Controllers\CategoryController@update')->name('category.update');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('category.destroy');
