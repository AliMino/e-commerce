<?php

namespace App\Services;

use App\Models\{ Store, User };
use App\Repositories\StoresRepository;
use App\Exceptions\Api\UnauthorizedAccessException;

/**
 * Store Business Service.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoreService {

    /**
     * @since 1.0.0
     * @var StoresRepository $storesRepository
     */
    private StoresRepository $storesRepository;

    /**
     * Creates a new StoreService instance on top of the specified StoresRepository instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param StoresRepository $storesRepository
     */
    public final function __construct(StoresRepository $storesRepository) {
        $this->storesRepository = $storesRepository;
    }

    /**
     * Creates a new Store with the specified name and merchant.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $name
     * @param User $merchant
     * @return Store
     * 
     * @throws UnauthorizedAccessException
     */
    public final function createStore(string $name, User $merchant): Store {
        // Since both consumers and merchants live happily together
        // in the same database table - named `users` actually; we have
        // to manually check if who is claiming to be a merchant really is.
        if (!$merchant->isMerchant()) {
            throw new UnauthorizedAccessException('Not a merchant');
        }

        return $this->storesRepository->createStore($name, $merchant->id);
    }
}
