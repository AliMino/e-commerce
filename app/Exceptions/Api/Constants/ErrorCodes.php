<?php

namespace App\Exceptions\Api\Constants;

/**
 * Errors(Exceptions) Codes.
 * 
 * @api
 * @final
 * @version 1.7.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ErrorCodes {

    public const NO_SUBDOMAIN_PROVIDED          = 1;
    public const UNKNWON_SUBDOMAIN              = 2;

    public const INVALID_INPUTS                 = 3;
    public const UN_AUTHORIZED_ACCESS           = 4;

    public const ROUTE_NOT_FOUND                = 5;
    public const SUBDOMAIN_NOT_FOUND            = 6;
    public const ENTITY_NOT_FOUND               = 7;
    public const PRODUCT_NOT_FOUND              = 8;
    
    public const EMAIL_ALREADY_EXISTS           = 9;
    public const STORE_NAME_ALREADY_EXISTS      = 10;
    public const PRODUCT_NAME_ALREADY_EXISTS    = 11;
    
    public const INVALID_USER_CREDENTIALS       = 12;
    public const STORE_NAME_DOESNOT_CHANGE      = 13;
    public const INVALID_CART_QUANTITY          = 14;
    public const INSUFFICIENT_PRODUCTS          = 15;
    public const INSUFFICIENT_CART_PRODUCTS     = 16;

}
