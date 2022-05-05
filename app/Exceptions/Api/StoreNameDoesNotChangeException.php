<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Store's Name Doesn't Change Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoreNameDoesNotChangeException extends ApiException {

    /**
     * Creates a new StoreNameDoesNotChangeException instance with the specified store name.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $storeName
     */
    public final function __construct(string $storeName) {
        parent::__construct(
            Constants\ErrorMessages::storeNameDoesnotChange(),
            Constants\ErrorCodes::STORE_NAME_DOESNOT_CHANGE,
            Response::HTTP_UNAUTHORIZED,
            compact('storeName')
        );
    }
}