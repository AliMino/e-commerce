<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UsersRepository;
use App\Exceptions\Api\{ EntityNotFoundException, InvalidUserCredentialsException, UnauthorizedAccessException, UserEmailAlreadyExistsException };

/**
 * User Business Service.
 * 
 * @api
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class UserService {

    /**
     * @since 1.0.0
     * @var RoleService $roleService
     */
    private RoleService $roleService;
    
    /**
     * @since 1.0.0
     * @var GeneralService $generalService
     */
    private GeneralService $generalService;

    /**
     * @since 1.0.0
     * @var UsersRepository $usersRepository
     */
    private UsersRepository $usersRepository;

    /**
     * Creates a new UserService instance with the specified arguments.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param RoleService $roleService
     * @param GeneralService $generalService
     * @param UsersRepository $usersRepository
     */
    public function __construct(
        RoleService $roleService,
        GeneralService $generalService,
        UsersRepository $usersRepository
    ) {
        $this->roleService      = $roleService;
        $this->generalService   = $generalService;
        $this->usersRepository  = $usersRepository;
    }

    /**
     * Creates a new User with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $roleName
     * @return User
     * 
     * @throws EntityNotFoundException If the specified role doesn't exist.
     * @throws UserEmailAlreadyExistsException
     */
    public final function createUser(string $name, string $email, string $password, string $roleName): User {
        if (!is_null($this->usersRepository->getUserByEmail($email))) {
            throw new UserEmailAlreadyExistsException($email);
        }

        return $this->usersRepository->createUser(
            $name,
            $email,
            $this->generalService->hash($password),
            $this->roleService->getRole($roleName)->id
        );
    }

    /**
     * Authenticate user and retrieves the access token.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param string $email
     * @param string $password
     * @param string $role
     * @return string
     * 
     * @throws InvalidUserCredentialsException
     * @throws UnauthorizedAccessException
     */
    public final function authenticateUser(string $email, string $password, string $role): string {
        if (is_null($user = $this->usersRepository->getUserByEmail($email))) {
            throw new InvalidUserCredentialsException($email);
        }
        if (!$this->generalService->checkHash($password, $user->password)) {
            throw new InvalidUserCredentialsException($email, $password);
        }
        
        if ($role != $user->role->name) {
            throw new UnauthorizedAccessException("$role required");
        }

        return $user->createToken('auth-token')->plainTextToken;
    }
}
