<?php

/**
 * Stores Routes.
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

Route::put('{storeId}', [ 'uses' => StoreController::class . '@updateStore' ]);
