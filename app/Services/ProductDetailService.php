<?php

namespace App\Services;

use App\Models\ProductDetail;
use Illuminate\Support\Collection;
use App\Repositories\ProductDetailsRepository;
use App\Exceptions\Api\{ EntityNotFoundException, ProductDetailAlreadyExistsException, ProductNameAlreadyExistsException };

/**
 * Product-Detail Business Service.
 * 
 * @api
 * @final
 * @version 1.1.1
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetailService {

    /**
     * @since 1.0.0
     * @var ProductDetailsRepository $productDetailsRepository
     */
    private ProductDetailsRepository $productDetailsRepository;

    /**
     * Creates a new ProductDetailService instance on top of the specified ProductDetailsRepository instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param ProductDetailsRepository $productDetailsRepository
     */
    public final function __construct(ProductDetailsRepository $productDetailsRepository) {
        $this->productDetailsRepository = $productDetailsRepository;
    }

    /**
     * Creates a new ProductDetail instance with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param integer $productId
     * @param integer $languageId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     */
    public final function createProductDetail(int $productId, int $languageId, string $name, ?string $description, float $price, string $currency, ?float $shippingCost = null): ProductDetail {
        
        $this->assertProductNameUniqueness($name);

        return $this->productDetailsRepository->createProductDetail($productId, $languageId, $name, $description, $price, $currency, $shippingCost);

    }

    /**
     * Retrieves a product detail by product name.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $name
     * @param boolean $throwIfNotFound
     * @return ProductDetail|null
     */
    public final function getProductDetailByName(string $name, bool $throwIfNotFound = true): ?ProductDetail {
        if (!is_null($productDetail = $this->productDetailsRepository->getProductDetailByName($name))) {
            return $productDetail;
        }

        if ($throwIfNotFound) {
            throw new EntityNotFoundException('ProductDetail', $name);
        }

        return null;
    }

    /**
     * Retrieves a product-detail by its ID.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $productDetailId
     * @param integer|null $productId
     * @return ProductDetail
     * 
     * @throws EntityNotFoundException
     */
    public final function getProductDetailById(int $productDetailId, ?int $productId = null): ProductDetail {
        if (is_null($productDetail = $this->productDetailsRepository->findProductDetail($productDetailId, $productId))) {
            throw new EntityNotFoundException('ProductDetail', $productDetailId);
        }

        return $productDetail;
    }

    /**
     * Retrieves all product-details for the specified product.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @return Collection
     */
    public final function getProductDetails(int $productId): Collection {
        return $this->productDetailsRepository->getProductDetails($productId);
    }

    /**
     * Updates the specified product-detail with the provided arguments.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.1
     *
     * @param integer $productDetailId
     * @param integer $productId
     * @param string|null $name
     * @param string|null $description
     * @param float|null $price
     * @param integer|null $languageId
     * @param string|null $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     * 
     * @throws ProductDetailAlreadyExistsException
     */
    public final function updateProductDetail(int $productDetailId, int $productId, ?string $name, ?string $description, ?float $price, ?int $languageId, ?string $currency, ?float $shippingCost): ProductDetail {

        $productDetails = $this->getProductDetails($productId);

        if (is_null($productDetails->where('id', $productDetailId)->first())) {
            throw new EntityNotFoundException('ProductDetail', $productDetailId);
        }
        if (!is_null($languageId) && !is_null($detail = $productDetails->where('language_id', $languageId)->first()) && $productDetailId != $detail->id) {
            throw new ProductDetailAlreadyExistsException($productId, $languageId);
        }
        
        return $this->productDetailsRepository->updateProductDetail($productDetailId, $name, $description, $price, $languageId, $currency, $shippingCost);
    }

    /**
     * Asserts that the specified product name doesn't belong to any existing product.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $productName
     * @return void
     * 
     * @throws ProductNameAlreadyExistsException
     */
    private function assertProductNameUniqueness(string $productName): void {
        if (!is_null($this->getProductDetailByName($productName, false))) {
            throw new ProductNameAlreadyExistsException($productName);
        }
    }
}
