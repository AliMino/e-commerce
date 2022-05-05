<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repositories\ProductsRepository;
use App\Exceptions\Api\{ EntityNotFoundException, UnauthorizedAccessException };

/**
 * Product Business Service.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductService {

    /**
     * @since 1.0.0
     * @var StoreService $storeService
     */
    private StoreService $storeService;

    /**
     * @since 1.0.0
     * @var ProductsRepository $productsRepository
     */
    private ProductsRepository $productsRepository;

    /**
     * Creates a new ProductService instance with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param StoreService $storeService
     * @param ProductsRepository $productsRepository
     */
    public final function __construct(StoreService $storeService, ProductsRepository $productsRepository) {
        $this->storeService       = $storeService;
        $this->productsRepository = $productsRepository;
    }

    /**
     * Retrieves all products.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer|null $storeId
     * @param integer|null $quantityThreshold
     * @return Collection
     */
    public final function getProducts(?int $storeId, ?int $quantityThreshold): Collection {
        
        $this->storeService->getStoreById($storeId);

        return $this->productsRepository->getProducts($storeId, $quantityThreshold);

    }

    /**
     * Creates a new product with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $storeId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param boolean $vatIncluded
     * @param integer|null $quantity
     * @return Product
     */
    public final function createProduct(int $storeId, string $name, ?string $description, float $price, bool $vatIncluded, ?int $quantity): Product {
        
        $this->storeService->getStoreById($storeId);

        return $this->productsRepository->createProduct($storeId, $name, $description, $price, $vatIncluded, $quantity ?? 0);

    }

    /**
     * Updates the product specified by the provided product id with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @param integer $storeId
     * @param string|null $name
     * @param string|null $description
     * @param float|null $price
     * @param boolean|null $vatIncluded
     * @param integer|null $quantity
     * @return Product
     * 
     * @throws UnauthorizedAccessException If the specified product doesn't belong to the specified store.
     */
    public final function updateProduct(int $productId, int $storeId, ?string $name, ?string $description, ?float $price, ?bool $vatIncluded, ?int $quantity): Product {

        $this->storeService->getStoreById($storeId);
        
        if ($storeId != $this->getProductById($productId)->store_id) {
            throw new UnauthorizedAccessException("This product doesn't belong to this store");
        }

        return $this->productsRepository->updateProduct($productId, $name, $description, $price, $vatIncluded, $quantity);
    }

    /**
     * Retrieves a product by its ID.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @return Product
     * 
     * @throws EntityNotFoundException
     */
    public final function getProductById(int $productId): Product {
        if (is_null($product = $this->productsRepository->findProduct($productId))) {
            throw new EntityNotFoundException('Product', $productId);
        }

        return $product;
    }
}
