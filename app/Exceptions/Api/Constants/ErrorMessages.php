<?php

namespace App\Exceptions\Api\Constants;

/**
 * Errors(Exceptions) Messages.
 * 
 * @api
 * @final
 * @version 1.7.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ErrorMessages {

    private const UNKNWON_SUBDOMAIN             = 'Unknown subdomain `%s`.';
    private const NO_SUBDOMAIN_PROVIDED         = 'No subdomain provided.';
    private const INVALID_INPUTS                = 'Invalid inputs.';
    private const ENTITY_NOT_FOUND              = "Entity `%s(%s)` doesn't exists.";
    private const UN_AUTHORIZED_ACCESS          = "Unauthorized access.";
    private const EMAIL_ALREADY_EXISTS          = "The provided email address already in use.";
    private const INVALID_USER_CREDENTIALS      = 'Either the specified email or password is/are wrong.';
    private const STORE_NAME_ALREADY_EXISTS     = "The provided store name already in use.";
    private const STORE_NAME_DOESNOT_CHANGE     = "New store name can't be the same as the old name.";
    private const ROUTE_NOT_FOUND               = "Route `%s` doesn't exist.";
    private const SUBDOMAIN_NOT_FOUND           = "Subdomain `%s` doesn't exist.";
    private const PRODUCT_NAME_ALREADY_EXISTS   = "This store already has the product `%s`.";
    private const PRODUCT_NOT_FOUND             = "The specified product(s) do(es)not exist(s).";
    private const INVALID_CART_QUANTITY         = "Cart quantities must be positive non-zero integers.";
    private const INSUFFICIENT_PRODUCTS         = "The required amount of the selected product(s) is not available right now.";
    private const INSUFFICIENT_CART_PRODUCTS    = "There're no enough products in cart.";

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

    public static final function routeNotFound(string $routeName): string {
        return sprintf(self::ROUTE_NOT_FOUND, $routeName);
    }

    public static final function subDomainNotFound(string $subDomain): string {
        return sprintf(self::SUBDOMAIN_NOT_FOUND, $subDomain);
    }

    public static final function productNameAlreadyExists(string $productName): string {
        return sprintf(self::PRODUCT_NAME_ALREADY_EXISTS, $productName);
    }

    public static final function productNotFound(): string {
        return self::PRODUCT_NOT_FOUND;
    }

    public static final function invalidCartQuantity(): string {
        return self::INVALID_CART_QUANTITY;
    }

    public static final function insufficientProducts(): string {
        return self::INSUFFICIENT_PRODUCTS;
    }

    public static final function insufficientCartProducts(): string {
        return self::INSUFFICIENT_CART_PRODUCTS;
    }
}
