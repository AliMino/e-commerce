<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Route Not-Found Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class RouteNotFoundException extends ApiException {

    /**
     * Creates a new RouteNotFoundException instance with the specified route name.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $routeName
     */
    public final function __construct(string $routeName) {
        parent::__construct(
            Constants\ErrorMessages::routeNotFound($routeName),
            Constants\ErrorCodes::ROUTE_NOT_FOUND,
            Response::HTTP_NOT_FOUND,
            compact('routeName')
        );
    }
}
