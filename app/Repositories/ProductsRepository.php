<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Products Database Repository.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductsRepository {

    /**
     * Retrieves all products.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer|null $store_id
     * @param integer|null $quantityThreshold
     * @return Collection
     */
    public final function getProducts(?int $store_id, ?int $quantityThreshold): Collection {

        return tenant()->run(function() use ($store_id, $quantityThreshold) {

            $productsQuery = Product::query();

            if (!is_null($store_id)) {
                $productsQuery->where('store_id', $store_id);
            }

            if (!is_null($quantityThreshold)) {
                $productsQuery->where('current_quantity', '>', $quantityThreshold);
            }

            return $productsQuery->get();

        });
    }

    /**
     * Creates a new product with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $store_id
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param boolean $vat_included
     * @param integer $current_quantity
     * @return Product
     */
    public final function createProduct(int $store_id, string $name, ?string $description, float $price, bool $vat_included, int $current_quantity): Product {

        return tenant()->run(function() use ($store_id, $name, $description, $price, $vat_included, $current_quantity) {
            
            return Product::create(compact('store_id', 'name', 'description', 'price', 'vat_included', 'current_quantity'));

        });

    }

    /**
     * Finds a product by its ID.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @return Product|null
     */
    public final function findProduct(int $productId): ?Product {

        return tenant()->run(function() use ($productId) {

            return Product::find($productId);

        });

    }

    /**
     * Updates the specified product.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $product_id
     * @param string|null $name
     * @param string|null $description
     * @param float|null $price
     * @param boolean|null $vat_included
     * @param integer|null $current_quantity
     * @return Product
     */
    public final function updateProduct(int $product_id, ?string $name, ?string $description, ?float $price, ?bool $vat_included, ?int $current_quantity): Product {

        return tenant()->run(function() use ($product_id, $name, $description, $price, $vat_included, $current_quantity) {
            
            $product = Product::find($product_id);

            if (!is_null($name)) {
                $product->name = $name;
            }

            if (!is_null($description)) {
                $product->description = $description;
            }

            if (!is_null($price)) {
                $product->price = $price;
            }

            if (!is_null($vat_included)) {
                $product->vat_included = $vat_included;
            }

            if (!is_null($current_quantity)) {
                $product->current_quantity = $current_quantity;
            }

            $product->save();

            return $product;

        });

    }
}
