<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\{ Builder, Collection };

/**
 * Products Database Repository.
 * 
 * @api
 * @final
 * @version 1.3.0
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
     * @version 2.0.0
     *
     * @param integer $store_id
     * @param boolean $vat_included
     * @param integer $current_quantity
     * @return Product
     */
    public final function createProduct(int $store_id, bool $vat_included, int $current_quantity): Product {

        return tenant()->run(function() use ($store_id, $vat_included, $current_quantity) {
            
            return Product::create(compact('store_id', 'vat_included', 'current_quantity'));

        });

    }

    /**
     * Finds a product by its ID.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param integer $productId
     * @param integer|null $storeId
     * @param bool $withDetails
     * @return Product|null
     */
    public final function findProduct(int $productId, ?int $storeId = null, bool $withDetails = false): ?Product {

        return tenant()->run(function() use ($productId, $storeId, $withDetails): ?Product {

            $productsQuery = Product::where('id', $productId);

            if (!is_null($storeId)) {
                $productsQuery->where('store_id', $storeId);
            }

            if ($withDetails) {
                $productsQuery->with('details');
            }

            return $productsQuery->first();

        });

    }

    /**
     * Updates the specified product.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer $product_id
     * @param boolean|null $vat_included
     * @param integer|null $current_quantity
     * @return Product
     */
    public final function updateProduct(int $product_id, ?bool $vat_included, ?int $current_quantity): Product {

        return tenant()->run(function() use ($product_id, $vat_included, $current_quantity) {
            
            $product = Product::find($product_id);

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

    /**
     * Deletes the product specified by the provided product ID.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $product_id
     * @return boolean
     */
    public final function deleteProduct(int $product_id): bool {

        return tenant()->run(function() use ($product_id) {

            return Product::destroy($product_id);

        });

    }

    /**
     * Retrieves the number of products having any of the specified IDs.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer[]|null $idsIn
     * @return integer
     */
    public final function getProductsCount(?array $idsIn): int {

        return tenant()->run(function() use ($idsIn): int {

            $productsQuery = Product::query();

            if (!is_null($idsIn)) {
                $productsQuery->whereIn('id', $idsIn);
            }

            return $productsQuery->count();

        });

    }

    /**
     * Retrieves the number of products that available with the required quantities.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer[][] $productsQuantities
     * @param boolean $lockForUpdate
     * @return integer
     */
    public final function getSufficientProductsCount(array $productsQuantities, bool $lockForUpdate = true): int {

        return tenant()->run(function() use ($productsQuantities, $lockForUpdate) {

            /** @var Builder $productsQuery */
            $productsQuery = $lockForUpdate ? Product::lockForUpdate() : Product::query();

            foreach ($productsQuantities as $productQuantity) {
                
                $productsQuery->orWhere(function(Builder $productQuery) use ($productQuantity) {

                    $productQuery->where('id', $productQuantity[ 'product_id' ])
                                 ->where('current_quantity', '>=', $productQuantity[ 'quantity' ]);

                });
            }

            return $productsQuery->count();

        });

    }

    /**
     * Deducts the specified quantity from the specified product's stock.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @param integer $quantity
     * @return void
     */
    public final function deductProductQuantity(int $productId, int $quantity): void {

        tenant()->run(function() use ($productId, $quantity) {

            $product = $this->findProduct($productId);
            $product->current_quantity -= $quantity;
            $product->save();

        });
    }
}
