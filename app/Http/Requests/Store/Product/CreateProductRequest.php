<?php

namespace App\Http\Requests\Store\Product;

use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Create Products Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CreateProductRequest extends MerchantStoreRequest {

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
            'name'          => [ 'required', 'string', 'min:3' ],
            'description'   => [ 'string', 'nullable' ],
            'price'         => [ 'required', 'numeric' ],
            'vat_included'  => [ 'required', 'boolean' ],
            'quantity'      => [ 'integer', 'min:0', 'nullable' ]
        ];
    }
}
