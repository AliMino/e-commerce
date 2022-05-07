<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Insufficient Cart Products Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class InsufficientCartProductsException extends ApiException {

    /**
     * Creates a new InsufficientCartProductsException instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     */
    public final function __construct() {
        parent::__construct(
            Constants\ErrorMessages::insufficientCartProducts(),
            Constants\ErrorCodes::INSUFFICIENT_CART_PRODUCTS,
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
