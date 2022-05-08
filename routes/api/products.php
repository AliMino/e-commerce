<?php

/**
 * Products Routes.
 * 
 * @internal
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// *****************************************************
// **** Applied Middlewares: tenant & auth:sanctum. ****
// *****************************************************

Route::controller(ProductController::class)->group(function() {
    
    Route::get('', 'getStoreProducts');
    
    Route::post('', 'createStoreProduct');
    
    Route::group([ 'prefix' => '{productId}' ], function() {
    
        Route::put('', 'updateStoreProduct');
    
        Route::prefix('details')->group(__DIR__ . '/product-details.php');

    });
    
});

Route::controller(CartController::class)->prefix('cart')->group(__DIR__ . '/carts.php');
