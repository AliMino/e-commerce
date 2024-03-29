<?php

namespace App\Services;

use App\Models\User;
use App\Constants\Roles;

/**
 * Consumer Business Service.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ConsumerService extends UserService {

    /**
     * Creates a new Consumer with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public final function createConsumer(string $name, string $email, string $password): User {
        return $this->createUser($name, $email, $password, Roles::CONSUMER)->load('role');
    }

    /**
     * Authenticate consumer and retrieves the access token.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $email
     * @param string $password
     * @return string
     * 
     * @throws InvalidUserCredentialsException
     * @throws UnauthorizedAccessException
     */
    public final function authenticateConsumer(string $email, string $password): string {
        return $this->authenticateUser($email, $password, Roles::CONSUMER);
    }

    /**
     * Gets the consumer specified by the provided consumer ID.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer $consumerId
     * @return User
     */
    public final function getConsumer(int $consumerId): User {
        return $this->getUser($consumerId, Roles::CONSUMER);
    }
}
