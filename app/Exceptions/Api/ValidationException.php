<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Validation Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ValidationException extends ApiException {

    /**
     * Creates a new ValidationException instance with the specified errors array.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string[][] $errors
     */
    public final function __construct(array $errors) {
        parent::__construct(
            Constants\ErrorMessages::invalidInputs(),
            Constants\ErrorCodes::INVALID_INPUTS,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            compact('errors')
        );
    }
}
