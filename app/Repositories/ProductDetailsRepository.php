<?php

namespace App\Repositories;

use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Collection;

/**
 * Product-Details Database Repository.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetailsRepository {

    /**
     * Creates a new ProductDetail instance with the provided arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer $product_id
     * @param integer $language_id
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @param float|null $shipping_cost
     * @return ProductDetail
     */
    public final function createProductDetail(int $product_id, int $language_id, string $name, ?string $description, float $price, string $currency, ?float $shipping_cost): ProductDetail {

        return tenant()->run(function() use ($product_id, $language_id, $name, $description, $price, $currency, $shipping_cost) {

            return ProductDetail::create(compact('product_id', 'language_id', 'name', 'description', 'price', 'currency', 'shipping_cost'));

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

    /**
     * Finds a product-detail by its ID.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer $productDetailId
     * @param integer|null $productId
     * @return ProductDetail|null
     */
    public final function findProductDetail(int $productDetailId, ?int $productId = null): ?ProductDetail {

        return tenant()->run(function() use ($productDetailId, $productId): ?ProductDetail {

            $productDetailsQuery = ProductDetail::where('id', $productDetailId);

            if (!is_null($productId)) {
                $productDetailsQuery->where('product_id', $productId);
            }

            return $productDetailsQuery->first();

        });

    }

    /**
     * Retrieves all product-details for the specified product.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @return Collection
     */
    public final function getProductDetails(int $productId): Collection {

        return tenant()->run(function() use ($productId): Collection {

            return ProductDetail::where('product_id', $productId)->get();

        });

    }

    /**
     * Updates the specified product-detail.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer $productDetailId
     * @param string|null $name
     * @param string|null $description
     * @param float|null $price
     * @param integer|null $languageId
     * @param string|null $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     */
    public final function updateProductDetail(int $productDetailId, ?string $name, ?string $description, ?float $price, ?int $languageId, ?string $currency, ?float $shippingCost): ProductDetail {

        return tenant()->run(function() use ($productDetailId, $name, $description, $price, $languageId, $currency, $shippingCost): ProductDetail {

            $productDetail = $this->findProductDetail($productDetailId);

            if (!is_null($name)) {
                $productDetail->name = $name;
            }

            if (!is_null($description)) {
                $productDetail->description = $description;
            }

            if (!is_null($price)) {
                $productDetail->price = $price;
            }

            if (!is_null($languageId)) {
                $productDetail->language_id = $languageId;
            }

            if (!is_null($currency)) {
                $productDetail->currency = $currency;
            }

            if (!is_null($shippingCost)) {
                $productDetail->shipping_cost = $shippingCost;
            }

            $productDetail->save();

            return $productDetail;
        });

    }
}
