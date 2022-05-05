<?php

namespace App\Repositories;

use App\Models\Store;

/**
 * Stores Database Repository.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoresRepository {
    
    /**
     * Creates a new Store with the specified name and merchant id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $name
     * @param integer $merchant_id
     * @return Store
     */
    public final function createStore(string $name, int $merchant_id): Store {
        return Store::create(compact('name', 'merchant_id'));
    }

}
