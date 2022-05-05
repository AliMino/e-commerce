<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Store's Name Already Exists Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoreNameAlreadyExistsException extends ApiException {

    /**
     * Creates a new StoreNameAlreadyExistsException instance with the specified store name.
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
            Constants\ErrorMessages::storeNameAlreadyExists(),
            Constants\ErrorCodes::STORE_NAME_ALREADY_EXISTS,
            Response::HTTP_UNAUTHORIZED,
            compact('storeName')
        );
    }
}