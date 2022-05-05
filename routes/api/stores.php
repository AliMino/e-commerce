<?php

/**
 * Stores Routes.
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

Route::group([ 'prefix' => '{storeId}' ], function() {

    Route::put('', [ 'uses' => StoreController::class . '@updateStore' ]);
    
    Route::group([   'prefix' => 'products' ], __DIR__ . '/store-products.php');

});

