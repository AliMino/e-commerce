<?php

namespace App\Http\Requests;

/**
 * Create User Request.
 * 
 * @api
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class CreateUserRequest extends ApiRequest {

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
            'name'                      => [ 'required', 'string' ],
            'email'                     => [ 'required', 'email', 'unique:users' ],
            'password'                  => [ 'required', 'string' ],
            'password_confirmation'     => [ 'required', 'same:password' ]
        ];
    }
}
