<?php

namespace App\Exceptions\Api\Constants;

/**
 * Errors(Exceptions) Messages.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ErrorMessages {

    private const UNKNWON_SUBDOMAIN     = 'Unknown subdomain `%s`.';
    private const NO_SUBDOMAIN_PROVIDED = 'No subdomain provided.';

    public static final function unknownSubdomain(string $subdomain): string {
        return sprintf(self::UNKNWON_SUBDOMAIN, $subdomain);
    }

    public static final function noSumdomainProvided(): string {
        return self::NO_SUBDOMAIN_PROVIDED;
    }
}
