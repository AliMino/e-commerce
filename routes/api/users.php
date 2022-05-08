<?php

/**
 * Users Routes.
 * 
 * @internal
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('auth', [ 'uses' => UserController::class . '@authenticateUser' ]);

Route::get('me', [ 'uses' => UserController::class . '@getLoggedInUser' ])->middleware('auth:api');
