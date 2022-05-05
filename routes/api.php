<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([ 'prefix' => 'tenants'        ], __DIR__ . '/api/tenants.php');


Route::middleware('tenant')->group(function() {
    
    // World-Wide Routes...
    Route::group([ 'prefix' => 'merchants'  ], __DIR__ . '/api/merchants.php');
    Route::group([ 'prefix' => 'consumers'  ], __DIR__ . '/api/consumers.php');
    
    // Protected Routes...
    Route::middleware('auth:sanctum')->group(function() {

        Route::group([ 'prefix' => 'stores'     ], __DIR__ . '/api/stores.php');

    });

});
