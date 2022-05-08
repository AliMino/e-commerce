<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Product's Detail Already Exists Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetailAlreadyExistsException extends ApiException {

    /**
     * Creates a new ProductDetailAlreadyExistsException instance with the specified product & language ID.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param integer $productId
     * @param integer $languageId
     */
    public final function __construct(int $productId, int $languageId) {
        parent::__construct(
            Constants\ErrorMessages::productDetailAlreadyExists(),
            Constants\ErrorCodes::PRODUCT_DETAIL_ALREADY_EXISTS,
            Response::HTTP_UNAUTHORIZED,
            compact('productId', 'languageId')
        );
    }
}