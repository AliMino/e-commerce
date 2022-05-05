<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Invalid User's Credentials Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class InvalidUserCredentialsException extends ApiException {

    /**
     * Creates a new InvalidUserCredentialsException instance with the specified credentials.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $email
     * @param string|null $password
     */
    public final function __construct(string $email, ?string $password = null) {
        parent::__construct(
            Constants\ErrorMessages::invalidUserCredentials(),
            Constants\ErrorCodes::INVALID_USER_CREDENTIALS,
            Response::HTTP_NOT_FOUND,
            compact('email', 'password')
        );
    }
}