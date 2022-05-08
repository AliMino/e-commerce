<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Product, Store, Tenant };

/**
 * Product Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param boolean $vat_included
     * @param integer $current_quantity
     * @param Store $store
     * @return Product
     */
    public function run(Tenant $tenant, bool $vat_included, int $current_quantity, Store $store): Product {
        
        $store_id = $store->id;
        return $tenant->run(function() use ($vat_included, $current_quantity, $store_id): Product {

            return Product::create(compact('vat_included', 'current_quantity', 'store_id'));

        });

    }
}
