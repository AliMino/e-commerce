<?php

namespace App\Http\Requests;

/**
 * Authentication Request.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class AuthenticationRequest extends Base\ApiRequest {

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
            'email'     => [ 'required', 'email'  ],
            'password'  => [ 'required', 'string' ]
        ];
    }
}
