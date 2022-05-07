<?php

namespace App\Http\Requests\Store\Product\Cart;

use App\Constants\Roles;
use App\Http\Requests\Base\ApiRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Update Shopping Cart Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UpdateCartRequest extends ApiRequest {

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

    /**
     * Gets the validation rules to be applied to inputs of this request.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return string[][]
     */
    public function rules(): array {
        return [
            '*'            => [ 'required', 'array', 'min:1' ],
            '*.product_id' => [ 'required', 'exists:products,id' ],
            '*.quantity'   => [ 'required', 'integer', 'min:1' ]
        ];
    }
}
