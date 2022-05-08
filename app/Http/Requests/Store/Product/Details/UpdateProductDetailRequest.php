<?php

namespace App\Http\Requests\Store\Product\Details;

use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Update Product-Detail Request.
 * 
 * @api
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class UpdateProductDetailRequest extends MerchantStoreRequest {

    /**
     * Gets the validation rules to be applied to inputs of this request.
     * 
     * @api
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return string[][]
     */
    public function rules(): array {
        return [
            'name'          => [ 'string', 'min:3' ],
            'description'   => [ 'string', 'nullable' ],
            'price'         => [ 'numeric' ],
            'language_id'   => [ 'numeric', 'exists:languages,id' ],
            'currency'      => [ 'string', 'min:1' ],
            'shipping_cost' => [ 'numeric', 'min:0' ],
        ];
    }
}
