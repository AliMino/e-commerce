<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Entity Not-Found Exception.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class EntityNotFoundException extends ApiException {

    /**
     * Creates a new EntityNotFoundException instance with the specified entity name and id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $entityName
     * @param string $entityId
     */
    public final function __construct(string $entityName, string $entityId) {
        parent::__construct(
            Constants\ErrorMessages::entityNotFound($entityName, $entityId),
            Constants\ErrorCodes::ENTITY_NOT_FOUND,
            Response::HTTP_NOT_FOUND,
            compact('entityName', 'entityId')
        );
    }
}
