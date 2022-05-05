<?php

/**
 * Products Routes.
 * 
 * @internal
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// *****************************************************
// **** Applied Middlewares: tenant & auth:sanctum. ****
// *****************************************************

Route::get('', [  'uses' => ProductController::class . '@getStoreProducts' ]);

Route::post('', [ 'uses' => ProductController::class . '@createStoreProduct' ]);

route::group([ 'prefix' => '{productId}' ], function() {

    Route::put('', [ 'uses' => ProductController::class . '@updateStoreProduct' ]);

});

