<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Language, Product, ProductDetail, Tenant };

/**
 * Product-Detail Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetailSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param Product $product
     * @param Language $language
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     */
    public final function run(Tenant $tenant, Product $product, Language $language, string $name, ?string $description, float $price, string $currency, ?float $shippingCost): ProductDetail {
        
        return $tenant->run(function() use ($product, $language, $name, $description, $price, $currency, $shippingCost): ProductDetail {

            return ProductDetail::create([
                'product_id' => $product->id,
                'language_id' => $language->id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'currency' => $currency,
                'shipping_cost' => $shippingCost,
            ]);

        });

    }
}
