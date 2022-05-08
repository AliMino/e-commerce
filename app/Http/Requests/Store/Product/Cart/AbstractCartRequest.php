<?php

namespace App\Http\Requests\Store\Product\Cart;

use App\Constants\Roles;
use App\Http\Requests\Base\ApiRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Abstract Shopping Cart Request.
 * 
 * @api
 * @abstract
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
abstract class AbstractCartRequest extends ApiRequest {

    /**
     * Authorization rules for the request
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @return boolean
     */
    public final function authorize() {
        return ! is_null($user = Auth::user()) && Roles::CONSUMER == $user->role->name;
    }
}
