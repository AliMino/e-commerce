<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Users Database Repository.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UsersRepository {

    /**
     * Creates a new User with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param integer $role_id
     * @return User
     */
    public final function createUser(string $name, string $email, string $password, int $role_id): User {
        
        return tenant()->run(function() use ($name, $email, $password, $role_id) {
        
            return User::create(compact('name', 'email', 'password', 'role_id'));

        });
        
    }

    /**
     * Retrieves the user having the specified email.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $email
     * @return \App\Models\User|null
     */
    public final function getUserByEmail(string $email): ?User {

        return tenant()->run(function() use ($email) {
        
            return User::where('email', $email)->first();

        });

    }
}
