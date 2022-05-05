<?php

namespace App\Repositories;

use App\Models\Store;

/**
 * Stores Database Repository.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoresRepository {
    
    /**
     * Creates a new Store with the specified name and merchant id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.1
     *
     * @param string $name
     * @param integer $merchant_id
     * @return Store
     */
    public final function createStore(string $name, int $merchant_id): Store {
        
        return tenant()->run(function() use ($name, $merchant_id) {
        
            return Store::create(compact('name', 'merchant_id'));
        
        });

    }

    /**
     * Finds a store by its ID.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $store_id
     * @return Store|null
     */
    public final function findStore(int $store_id): ?Store {

        return tenant()->run(function() use ($store_id) {

            return Store::find($store_id);

        });

    }

    /**
     * Retrieves a store by its name.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $store_name
     * @return Store|null
     */
    public final function getStoreByName(string $store_name): ?Store {
        
        return tenant()->run(function() use ($store_name) {

            return Store::where('name', $store_name)->first();

        });

    }

    /**
     * Updates the store specified by the provided store id with the provided arguments.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $store_id
     * @param string|null $name
     * @return Store
     */
    public final function updateStore(int $store_id, ?string $name = null): Store {
        
        return tenant()->run(function() use ($store_id, $name) {

            $store = Store::find($store_id);

            if (!is_null($name)) {
                $store->name = $name;
            }

            $store->save();

            return $store;

        });

    }
}
