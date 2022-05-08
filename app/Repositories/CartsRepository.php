<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

/**
 * Roles Database Repository.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CartsRepository {

    /**
     * Creates a new cart items.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $consumer_id
     * @param integer[][] $productsQuantities
     * @return boolean
     */
    public final function createCarts(int $consumer_id, array $productsQuantities): bool {

        return tenant()->run(function() use ($consumer_id, $productsQuantities): bool {

            return Cart::insert(array_map(
                function(array $productQuantity) use ($consumer_id): array {
                    return array_merge($productQuantity, compact('consumer_id'));
                },
                $productsQuantities
            ));

        });

    }

    /**
     * Retrieves the shopping cart items for the specified consumer.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer $consumerId
     * @param integer[]|null $productIds
     * @param boolean $withProducts
     * @param boolean $withStore
     * @param boolean $withDetails
     * @return Collection
     */
    public final function getCarts(int $consumerId, ?array $productIds, bool $withProducts, bool $withStore, bool $withDetails): Collection {

        return tenant()->run(function() use ($consumerId, $productIds, $withProducts, $withStore, $withDetails): Collection {

            $cartsQuery = Cart::where('consumer_id', $consumerId);

            if (!is_null($productIds)) {
                $cartsQuery->whereIn('product_id', $productIds);
            }

            if ($withProducts) {
                $cartsQuery->with('product');
            }
            
            if ($withStore) {
                $cartsQuery->with('product.store');
            }

            if ($withDetails) {
                $cartsQuery->with('product.details');
            }

            return $cartsQuery->get();

        });

    }

    /**
     * Updates the specified shopping cart items.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer[][] $cartsQuantities
     * @return integer
     */
    public final function updateCarts(array $cartsQuantities): int {

        return tenant()->run(function() use ($cartsQuantities): int {

            return DB::update(
                'UPDATE ' . ((new Cart)->getTable()) .
                "\nSET quantity = CASE\n" .
                implode('', array_map(
                    fn(array $cartQuantity) => sprintf("\tWHEN id = %d THEN %d\n", $cartQuantity['cart_id'], $cartQuantity['quantity']),
                    $cartsQuantities
                )) .
                "END\nWHERE id IN (" .
                    implode(', ', array_column($cartsQuantities, 'cart_id')) .
                ');'
            );

        });

    }

    /**
     * Deletes the shopping cart items specified by the provided carts IDs.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer[] $cartsIds
     * @return integer
     */
    public final function deleteCarts(array $cartsIds): int {

        return tenant()->run(function() use ($cartsIds): int {

            return Cart::destroy($cartsIds);

        });

    }
}
