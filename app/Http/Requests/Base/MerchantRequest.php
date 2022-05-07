<?php

namespace App\Http\Requests\Base;

use App\Models\User;
use App\Constants\Roles;
use Illuminate\Support\Facades\Auth;

/**
 * Merchant API Request.
 * 
 * @api
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class MerchantRequest extends ApiRequest {

    /**
     * Authorization rules for the request
     * 
     * @api
     * @override
     * @since 1.0.0
     * @version 1.1.0
     * 
     * @return boolean
     */
    public function authorize() {
        return ! is_null($user = Auth::user()) && Roles::MERCHANT == $user->role->name;
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
