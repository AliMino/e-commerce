<?php

/**
 * Tenants Routes.
 * 
 * @internal
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('', [ 'uses' => TenantController::class . '@createTenant' ]);

Route::get('me', [ 'uses' => TenantController::class . '@getCurrentTenant' ])->middleware('tenant');
