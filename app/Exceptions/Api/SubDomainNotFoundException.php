<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Sub-Domain Not-Found Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class SubDomainNotFoundException extends ApiException {

    /**
     * Creates a new SubDomainNotFoundException instance with the specified sub-domain.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $subDomain
     */
    public final function __construct(string $subDomain) {
        parent::__construct(
            Constants\ErrorMessages::subDomainNotFound($subDomain),
            Constants\ErrorCodes::SUBDOMAIN_NOT_FOUND,
            Response::HTTP_NOT_FOUND,
            compact('subDomain')
        );
    }
}
