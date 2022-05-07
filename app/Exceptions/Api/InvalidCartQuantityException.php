<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Invalid Cart's Quantity  Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class InvalidCartQuantityException extends ApiException {

    /**
     * Creates a new InvalidCartQuantityException instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     */
    public final function __construct() {
        parent::__construct(
            Constants\ErrorMessages::invalidCartQuantity(),
            Constants\ErrorCodes::INVALID_CART_QUANTITY,
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
