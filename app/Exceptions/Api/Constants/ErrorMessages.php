<?php

namespace App\Exceptions\Api\Constants;

/**
 * Errors(Exceptions) Messages.
 * 
 * @api
 * @final
 * @version 1.4.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ErrorMessages {

    private const UNKNWON_SUBDOMAIN         = 'Unknown subdomain `%s`.';
    private const NO_SUBDOMAIN_PROVIDED     = 'No subdomain provided.';
    private const INVALID_INPUTS            = 'Invalid inputs.';
    private const ENTITY_NOT_FOUND          = "Entity `%s(%s)` doesn't exists.";
    private const UN_AUTHORIZED_ACCESS      = "Unauthorized access.";
    private const EMAIL_ALREADY_EXISTS      = "The provided email address already in use.";
    private const INVALID_USER_CREDENTIALS  = 'Either the specified email or password is/are wrong.';
    private const STORE_NAME_ALREADY_EXISTS = "The provided store name already in use.";
    private const STORE_NAME_DOESNOT_CHANGE = "New store name can't be the same as the old name.";

    public static final function unknownSubdomain(string $subdomain): string {
        return sprintf(self::UNKNWON_SUBDOMAIN, $subdomain);
    }

    public static final function noSumdomainProvided(): string {
        return self::NO_SUBDOMAIN_PROVIDED;
    }

    public static final function invalidInputs(): string {
        return self::INVALID_INPUTS;
    }

    public static final function entityNotFound(string $entityName, string $id): string {
        return sprintf(self::ENTITY_NOT_FOUND, $entityName, $id);
    }

    public static final function unAuthorizedAccess(): string {
        return self::UN_AUTHORIZED_ACCESS;
    }

    public static final function emailAlreadyExists(): string {
        return self::EMAIL_ALREADY_EXISTS;
    }

    public static final function invalidUserCredentials(): string {
        return self::INVALID_USER_CREDENTIALS;
    }

    public static final function storeNameAlreadyExists(): string {
        return self::STORE_NAME_ALREADY_EXISTS;
    }

    public static final function storeNameDoesnotChange(): string {
        return self::STORE_NAME_DOESNOT_CHANGE;
    }
}
