<?php

namespace App\Services;

use App\Models\{ Store, User };
use App\Repositories\StoresRepository;
use App\Exceptions\Api\{
    EntityNotFoundException, StoreNameAlreadyExistsException, StoreNameDoesNotChangeException, UnauthorizedAccessException
};

/**
 * Store Business Service.
 * 
 * @api
 * @final
 * @version 1.1.0
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
     * @version 1.1.0
     *
     * @param string $name
     * @param User $merchant
     * @return Store
     * 
     * @throws UnauthorizedAccessException
     * @throws StoreNameAlreadyExistsException
     */
    public final function createStore(string $name, User $merchant): Store {
        // Since both consumers and merchants live happily together
        // in the same database table - named `users` actually; we have
        // to manually check if who is claiming to be a merchant really is.
        if (!$merchant->isMerchant()) {
            throw new UnauthorizedAccessException('Not a merchant');
        }

        $this->assertStoreNameUniqueness($name);

        return $this->storesRepository->createStore($name, $merchant->id);
    }

    /**
     * Updates the store specified by the provided store id with the provided arguments.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $storeId
     * @param string|null $newName
     * @return Store
     * 
     * @throws StoreNameDoesNotChangeException
     */
    public final function updateStore(int $storeId, ?string $newName): Store {
        $store = $this->getStoreById($storeId);

        if (!is_null($newName)) {
            if ($newName == $store->name) {
                throw new StoreNameDoesNotChangeException($newName);
            }
            
            $this->assertStoreNameUniqueness($newName);
        }

        return $this->storesRepository->updateStore($storeId, $newName);
    }

    /**
     * Retrieves a store by its ID.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $storeId
     * @return Store
     * 
     * @throws EntityNotFoundException
     */
    public final function getStoreById(int $storeId): Store {
        if (is_null($store = $this->storesRepository->findStore($storeId))) {
            throw new EntityNotFoundException('Store', $storeId);
        }

        return $store;
    }

    /**
     * Retrieves a store by its name.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $storeName
     * @param boolean $throwIfNotExists
     * @return Store|null
     * 
     * @throws EntityNotFoundException
     */
    public final function getStoreByName(string $storeName, bool $throwIfNotExists = true): ?Store {
        if (!is_null($store = $this->storesRepository->getStoreByName($storeName))) {
            return $store;
        }

        if ($throwIfNotExists) {
            throw new EntityNotFoundException('Store', $storeName);
        }

        return null;
    }

    /**
     * Asserts that the specified store name doesn't belong to any existing store.
     * 
     * @internal
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $storeName
     * @return void
     * 
     * @throws StoreNameAlreadyExistsException
     */
    private function assertStoreNameUniqueness(string $storeName): void {
        if (!is_null($this->getStoreByName($storeName, false))) {
            throw new StoreNameAlreadyExistsException($storeName);
        }
    }
}
