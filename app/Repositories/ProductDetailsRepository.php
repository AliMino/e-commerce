<?php

namespace App\Repositories;

use App\Models\ProductDetail;

/**
 * Product-Details Database Repository.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetailsRepository {

    /**
     * Creates a new ProductDetail instance with the provided arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $product_id
     * @param integer $language_id
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @return ProductDetail
     */
    public final function createProductDetail(int $product_id, int $language_id, string $name, ?string $description, float $price, string $currency): ProductDetail {

        return tenant()->run(function() use ($product_id, $language_id, $name, $description, $price, $currency) {

            return ProductDetail::create(compact('product_id', 'language_id', 'name', 'description', 'price', 'currency'));

        });

    }

    /**
     * Retrieves a product details by a product name.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $name
     * @return ProductDetail|null
     */
    public final function getProductDetailByName(string $name): ?ProductDetail {

        return tenant()->run(function() use ($name) {

            return ProductDetail::where('name', $name)->first();

        });

    }
}
