<?php

/**
 * Consumers Routes.
 * 
 * @internal
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// **************************************
// **** Applied Middlewares: tenant. ****
// **************************************

Route::post('register', [ 'uses' => ConsumerController::class . '@createConsumer' ]);

Route::post('login',    [ 'uses' => ConsumerController::class . '@authenticateConsumer' ]);
