<?php

namespace App\Repositories;

use App\Models\Role;

/**
 * Roles Database Repository.
 * 
 * @api
 * @final
 * @version 1.0.1
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class RolesRepository {

    /**
     * Retrieves the Role specified by the provided role name.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.1
     *
     * @param string $roleName
     * @return Role|null
     */
    public final function getRole(string $roleName): ?Role {
        
        return tenant()->run(function() use ($roleName) {

            return Role::where('name', $roleName)->first();

        });

    }
}
