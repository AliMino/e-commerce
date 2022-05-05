<?php

namespace App\Exceptions\Api\Constants;

/**
 * Errors(Exceptions) Codes.
 * 
 * @api
 * @final
 * @version 1.4.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ErrorCodes {

    public const NO_SUBDOMAIN_PROVIDED      = 1;
    public const UNKNWON_SUBDOMAIN          = 2;

    public const INVALID_INPUTS             = 3;
    public const UN_AUTHORIZED_ACCESS       = 4;

    public const ENTITY_NOT_FOUND           = 5;
    public const EMAIL_ALREADY_EXISTS       = 6;
    public const INVALID_USER_CREDENTIALS   = 7;
    public const STORE_NAME_ALREADY_EXISTS  = 8;
    public const STORE_NAME_DOESNOT_CHANGE  = 9;

}
