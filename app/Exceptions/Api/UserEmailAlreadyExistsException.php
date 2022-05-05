<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * User's Email Already Exists Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UserEmailAlreadyExistsException extends ApiException {

    /**
     * Creates a new UserEmailAlreadyExists instance with the specified email.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $email
     */
    public final function __construct(string $email) {
        parent::__construct(
            Constants\ErrorMessages::emailAlreadyExists(),
            Constants\ErrorCodes::EMAIL_ALREADY_EXISTS,
            Response::HTTP_FORBIDDEN,
            compact('email')
        );
    }
}
