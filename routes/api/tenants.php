<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('', [ 'uses' => TenantController::class . '@createTenant' ]);

Route::get('me', [ 'uses' => TenantController::class . '@getCurrentTenant' ])->middleware('tenant');
