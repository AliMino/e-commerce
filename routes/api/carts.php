<?php

/**
 * Carts Routes.
 * 
 * @internal
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// *************************************************
// **** Applied Middlewares: tenant & auth:api. ****
// *************************************************

Route::get('', 'getCart');

Route::post('add', 'addToCart');

Route::post('remove', 'removeFromCart');
