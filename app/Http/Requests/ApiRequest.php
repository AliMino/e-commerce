<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\Api\{ ValidationException, UnauthorizedAccessException };

/**
 * API Request.
 * 
 * @api
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class ApiRequest extends FormRequest {

    /**
     * Authorization rules for the request
     * 
     * @api
     * @since 1.0.0
     * @version 1.1.0
     * 
     * @return boolean
     */
    public function authorize() {
        return true;
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

    /**
     * Handle a failed authorization attempt.
     * 
     * @internal
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return void
     *
     * @throws UnauthorizedAccessException
     */
    protected function failedAuthorization() {
        throw new UnauthorizedAccessException();
    }
}
