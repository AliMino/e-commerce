<?php

namespace App\Services;

use App\Models\User;
use App\Constants\Roles;
use App\Repositories\UsersRepository;

/**
 * Merchant Business Service.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class MerchantService extends UserService {

    /**
     * @since 1.0.0
     * @var StoreService $storeService;
     */
    private StoreService $storeService;

    /**
     * Creates a new MerchantService instance with the specified arguments.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param RoleService $roleService
     * @param StoreService $storeService
     * @param GeneralService $generalService
     * @param UsersRepository $usersRepository
     */
    public final function __construct(
        RoleService $roleService,
        StoreService $storeService,
        GeneralService $generalService,
        UsersRepository $usersRepository
    ) {
        parent::__construct($roleService, $generalService, $usersRepository);
        $this->storeService = $storeService;
    }

    /**
     * Creates a new Merchant with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $storeName
     * @param float|null $storeVatPercentage
     * @return User
     */
    public final function createMerchant(string $name, string $email, string $password, string $storeName, ?float $storeVatPercentage): User {
        
        $merchant = $this->createUser($name, $email, $password, Roles::MERCHANT);

        $this->storeService->createStore($storeName, $merchant, $storeVatPercentage);

        return $merchant->load('stores');
        
    }

    /**
     * Authenticate merchant and retrieves the access token.
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
    public final function authenticateMerchant(string $email, string $password): string {
        return $this->authenticateUser($email, $password, Roles::MERCHANT);
    }
}
