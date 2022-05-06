<?php

namespace App\Http\Requests\Store\Product;

use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Create Products Request.
 * 
 * @api
 * @final
 * @version 1.1.0
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
     * @version 1.1.0
     *
     * @return string[][]
     */
    public final function rules(): array {
        return [
            'vat_included'          => [ 'required', 'boolean' ],
            'quantity'              => [ 'integer', 'min:0', 'nullable' ],
            'details'               => [ 'required', 'array' ],
            'details.name'          => [ 'required', 'string', 'min:3' ],
            'details.description'   => [ 'string', 'nullable' ],
            'details.price'         => [ 'required', 'numeric' ],
            'details.language_id'   => [ 'required', 'numeric', 'exists:languages,id' ],
            'details.currency'      => [ 'required', 'string', 'min:1' ],
        ];
    }
}
