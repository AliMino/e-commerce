<?php

namespace App\Http\Requests;

/**
 * CreateMerchant API Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CreateMerchantRequest extends CreateUserRequest {

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
        return array_merge(parent::rules(), [
            'store_name' => [ 'required', 'string', 'unique:stores,name' ]
        ]);
    }
}
