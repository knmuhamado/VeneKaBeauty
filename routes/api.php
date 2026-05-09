<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', 'App\Http\Controllers\Api\ProductApiController@index')
    ->name('api.product.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/beauty-assistant/history', 'App\Http\Controllers\Api\BeautyAssistantController@history')
        ->name('api.beauty-assistant.history');

    Route::post('/beauty-assistant/chat', 'App\Http\Controllers\Api\BeautyAssistantController@chat')
        ->name('api.beauty-assistant.chat');
});