<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Constants\Roles;
use Illuminate\Support\Facades\Auth;

/**
 * Merchant API Request.
 * 
 * @api
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class MerchantRequest extends ApiRequest {

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
    
        if (is_null($user = Auth::user())) {
            return false;
        }

        if (Roles::MERCHANT != $user->role->name) {
            return false;
        }

        return true;
    }

    /**
     * Checks whether the specified merchant is authorized for the store specified by the proided store id, or not.
     * 
     * @final
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param User $merchant
     * @param integer $storeId
     * @return boolean
     */
    protected final function isMerchantAuthorizedForStore(User $merchant, int $storeId): bool {
        return $merchant->stores->pluck('id')->contains($storeId);
    }
} 
