<?php

namespace App\Services;

use App\Models\ProductDetail;
use App\Repositories\ProductDetailsRepository;
use App\Exceptions\Api\{ EntityNotFoundException, ProductNameAlreadyExistsException };

/**
 * Product-Detail Business Service.
 * 
 * @api
 * @final
 * @version 1.0.0
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
     * @version 1.0.0
     *
     * @param integer $productId
     * @param integer $languageId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @return ProductDetail
     */
    public final function createProductDetail(int $productId, int $languageId, string $name, ?string $description, float $price, string $currency): ProductDetail {
        
        $this->assertProductNameUniqueness($name);

        return $this->productDetailsRepository->createProductDetail($productId, $languageId, $name, $description, $price, $currency);

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
