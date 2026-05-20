<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', 'App\Http\Controllers\Api\ProductApiController@index')->name('api.product.index');

Route::middleware(['web', 'auth:web'])->group(function () {
    Route::post('/beauty-assistant/chat', 'App\Http\Controllers\Api\AssistantApiController@chat')->name('api.beauty-assistant.chat');
});
