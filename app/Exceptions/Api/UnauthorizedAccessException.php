<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Unauthorized Access Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UnauthorizedAccessException extends ApiException {

    /**
     * Creates a new UnauthorizedAccessException instance with the specified optional description.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string|null $description
     */
    public final function __construct(?string $description = null) {
        parent::__construct(
            Constants\ErrorMessages::unAuthorizedAccess(),
            Constants\ErrorCodes::UN_AUTHORIZED_ACCESS,
            Response::HTTP_UNAUTHORIZED,
            is_null($description) ? [] : compact('description')
        );
    }
}
