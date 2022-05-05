<?php

namespace App\Http\Requests\Store\Product;

use App\Constants\Roles;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Store\MerchantStoreRequest;

/**
 * Get Products Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class GetProductsRequest extends MerchantStoreRequest {

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
        return Roles::CONSUMER == Auth::user()->role->name || parent::authorize();
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
    public final function rules(): array {
        return [
            'having_quantity_more_than' => [ 'integer', 'min:0' ]
        ];
    }
}
