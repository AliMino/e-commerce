<?php

namespace App\Http\Requests\Store\Product\Cart;

/**
 * Update Shopping Cart Request.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UpdateCartRequest extends AbstractCartRequest {

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
    public final function rules(): array {
        return [
            '*'            => [ 'required', 'array', 'min:1' ],
            '*.product_id' => [ 'required', 'exists:products,id' ],
            '*.quantity'   => [ 'required', 'integer', 'min:1' ]
        ];
    }
}
