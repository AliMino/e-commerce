<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('', [ 'uses' => UserController::class . '@createUser' ]);
    
Route::post('auth', [ 'uses' => UserController::class . '@authenticateUser' ]);

Route::get('me', [ 'uses' => UserController::class . '@getLoggedInUser' ])->middleware('auth:sanctum');
