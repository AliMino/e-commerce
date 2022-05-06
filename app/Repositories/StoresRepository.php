<?php

namespace App\Repositories;

use App\Models\Store;

/**
 * Stores Database Repository.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoresRepository {
    
    /**
     * Creates a new Store with the specified name and merchant id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param string $name
     * @param integer $merchant_id
     * @param float|null $vat_percentage
     * @return Store
     */
    public final function createStore(string $name, int $merchant_id, ?float $vat_percentage): Store {
        
        return tenant()->run(function() use ($name, $merchant_id, $vat_percentage) {
        
            return Store::create(compact('name', 'merchant_id', 'vat_percentage'));
        
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
     * @version 2.0.0
     *
     * @param integer $store_id
     * @param string|null $name
     * @param float|null $vat_percentage
     * @return Store
     */
    public final function updateStore(int $store_id, ?string $name, ?float $vat_percentage): Store {
        
        return tenant()->run(function() use ($store_id, $name, $vat_percentage) {

            $store = Store::find($store_id);

            if (!is_null($name)) {
                $store->name = $name;
            }

            if (!is_null($vat_percentage)) {
                $store->vat_percentage = $vat_percentage;
            }

            $store->save();

            return $store;

        });

    }
}
