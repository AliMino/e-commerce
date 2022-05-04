<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * No Subdomain Provided Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class NoSubdomainProvidedException extends ApiException {

    /**
     * Creates a new NoSubdomainProvidedException instance.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     */
    public final function __construct() {
        parent::__construct(
            Constants\ErrorMessages::noSumdomainProvided(),
            Constants\ErrorCodes::NO_SUBDOMAIN_PROVIDED,
            Response::HTTP_UNAUTHORIZED
        );
    }
}