<?php

namespace App\Http\Requests\Store;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Base\MerchantRequest;

/**
 * Merchant Store Request.
 * 
 * @api
 * @abstract
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
abstract class MerchantStoreRequest extends MerchantRequest {

    /**
     * Authorization rules for the request
     * 
     * @api
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @return boolean
     */
    public function authorize() {
        return parent::authorize() && $this->isMerchantAuthorizedForStore(Auth::user(), request()->route('storeId'));
    }
}
