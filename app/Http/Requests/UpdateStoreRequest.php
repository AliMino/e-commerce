<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

/**
 * Update Store Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UpdateStoreRequest extends MerchantRequest {

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
        return parent::authorize() && $this->isMerchantAuthorizedForStore(Auth::user(), request()->route('storeId'));
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
            'new_name' => [ 'string', 'nullable' ]
        ];
    }
}
