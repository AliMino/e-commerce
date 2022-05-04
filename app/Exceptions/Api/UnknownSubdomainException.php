<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Unknown Subdomain Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UnknownSubdomainException extends ApiException {

    /**
     * Creates a new UnknownSubdomainException instance with the specified subdomain name.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $subdomain
     */
    public final function __construct(string $subdomain) {
        parent::__construct(
            Constants\ErrorMessages::unknownSubdomain($subdomain),
            Constants\ErrorCodes::UNKNWON_SUBDOMAIN,
            Response::HTTP_NOT_FOUND,
            compact('subdomain')
        );
    }
}