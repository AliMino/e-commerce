<?php

namespace App\Http\Requests\Store\Product\Details;

use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Create Product-Detail Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CreateProductDetailRequest extends UpdateProductDetailRequest {

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
        $rules = parent::rules();
        
        foreach (array_keys($rules) as $input) {
            if (in_array($input, [ 'name', 'price', 'language_id', 'currency' ])) {
                $rules[ $input ][] = 'required';
            }
        }

        return $rules;
    }
}
