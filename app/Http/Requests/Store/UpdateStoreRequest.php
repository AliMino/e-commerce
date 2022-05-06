<?php

namespace App\Http\Requests\Store;

/**
 * Update Store Request.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UpdateStoreRequest extends MerchantStoreRequest {

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
            'new_name'       => [ 'string', 'nullable' ],
            'vat_percentage' => [ 'numeric', 'min:0', 'max:1', 'nullable' ],
        ];
    }
}
