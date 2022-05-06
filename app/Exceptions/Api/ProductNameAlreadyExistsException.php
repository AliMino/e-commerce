<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Product's Name Already Exists Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductNameAlreadyExistsException extends ApiException {

    /**
     * Creates a new ProductNameAlreadyExistsException instance with the specified product name.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $productName
     */
    public final function __construct(string $productName) {
        parent::__construct(
            Constants\ErrorMessages::productNameAlreadyExists($productName),
            Constants\ErrorCodes::PRODUCT_NAME_ALREADY_EXISTS,
            Response::HTTP_UNAUTHORIZED,
            compact('productName')
        );
    }
}