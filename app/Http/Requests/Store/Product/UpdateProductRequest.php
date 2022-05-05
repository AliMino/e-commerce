<?php

namespace App\Http\Requests\Store\Product;

use App\Constants\Validation;
use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Update Products Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UpdateProductRequest extends MerchantStoreRequest {

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
            'name'          => [ 'string', 'min:' . Validation::PRODUCT_NAME_MIN_LENGTH ],
            'description'   => [ 'string' ],
            'price'         => [ 'numeric' ],
            'vat_included'  => [ 'boolean' ],
            'quantity'      => [ 'integer', 'min:0' ]
        ];
    }
}
