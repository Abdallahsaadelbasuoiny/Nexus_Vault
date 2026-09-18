<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('products', ProductApiController::class);
    Route::post('products/{product}/active', [ProductApiController::class, 'isActive'])
        ->name('products.isActive');
});