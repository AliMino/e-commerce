<?php

namespace Database\Seeders;

use App\Models\{ Store, Tenant, User};
use Illuminate\Database\Seeder;

/**
 * Store Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoreSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param string $name
     * @param User $merchant
     * @return Store
     */
    public function run(Tenant $tenant, string $name, User $merchant): Store {
        
        return $tenant->run(function() use ($name, $merchant) {

            return Store::create([ 'name' => $name, 'merchant_id' => $merchant->id ]);

        });

    }
}
