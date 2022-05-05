<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\Api\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

/**
 * API Request.
 * 
 * @api
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class ApiRequest extends FormRequest {

    /**
     * The names of the allowed user roles.
     * 
     * @since 1.0.0
     * @var string[] ALLOWED_ROLES
     */
    protected const ALLOWED_ROLES = [];

    /**
     * Whether to allow anonymous users to access the requested resource, or not.
     * 
     * @since 1.0.0
     * @var boolean ALLOWS_ANONYMOUS_USER
     */
    protected const ALLOWS_ANONYMOUS_USER = true;

    /**
     * Authorization rules for the request
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @return boolean
     */
    public function authorize() {
        if (is_null($user = Auth::user())) {
            return static::ALLOWS_ANONYMOUS_USER;
        }

        return in_array($user->role->name, static::ALLOWED_ROLES);
    }

    /**
     * Gets the validation rules to be applied to inputs of this request.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return string[][]
     */
    public function rules(): array {
        return [];
    }

    /**
     * Handle a failed validation attempt.
     * 
     * @internal
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param  Validator  $validator
     * @return void
     * 
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator) {
        throw new ValidationException($validator->errors()->messages());
    }
}
