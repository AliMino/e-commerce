<?php

namespace App\Services;

use App\Models\Role;
use App\Exceptions\Api\EntityNotFoundException;
use App\Repositories\RolesRepository;

/**
 * Role Business Service.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class RoleService {

    /**
     * @since 1.0.0
     * @var RolesRepository $rolesRepository
     */
    private RolesRepository $rolesRepository;

    /**
     * Creates a new RoleService instance on top of the specified RolesRepository instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param RolesRepository $rolesRepository
     */
    public final function __construct(RolesRepository $rolesRepository) {
        $this->rolesRepository = $rolesRepository;
    }

    /**
     * Retrieves the Role specified by the provided role name.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $roleName
     * @return Role
     * 
     * @throws EntityNotFoundException
     */
    public final function getRole(string $roleName): Role {
        if (is_null($role = $this->rolesRepository->getRole($roleName))) {
            throw new EntityNotFoundException('Role', $roleName);
        }

        return $role;
    }
}
