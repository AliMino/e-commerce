<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Support\{ Collection, Facades\DB };
use App\Exceptions\Api\{ EntityNotFoundException, UnauthorizedAccessException };

/**
 * Product Business Service.
 * 
 * @api
 * @final
 * @version 1.1.0
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
     * @since 1.1.0
     * @var ProductDetailService $productDetailService
     */
    private ProductDetailService $productDetailService;

    /**
     * Creates a new ProductService instance with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param StoreService $storeService
     * @param ProductsRepository $productsRepository
     * @param ProductDetailService $productDetailService
     */
    public final function __construct(
        StoreService $storeService,
        ProductsRepository $productsRepository,
        ProductDetailService $productDetailService
    ) {
        $this->storeService         = $storeService;
        $this->productsRepository   = $productsRepository;
        $this->productDetailService = $productDetailService;
    }

    /**
     * Retrieves all products.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer|null $storeId
     * @param integer|null $quantityThreshold
     * @return Collection
     */
    public final function getProducts(?int $storeId, ?int $quantityThreshold, bool $withDetails): Collection {
        
        $this->storeService->getStoreById($storeId);

        $products = $this->productsRepository->getProducts($storeId, $quantityThreshold);

        return $withDetails ? $products->load('details') :$products;
    }

    /**
     * Creates a new product with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param integer $storeId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param boolean $vatIncluded
     * @param integer|null $quantity
     * @return Product
     */
    public final function createProduct(int $storeId, string $name, ?string $description, float $price, int $languageId, string $currency, bool $vatIncluded, ?int $quantity): Product {
        
        /** @var Product|null $product */
        $product = null;
        
        DB::transaction(function() use ($storeId, &$product, $name, $description, $price, $languageId, $currency , $vatIncluded, $quantity) {
            
            $this->storeService->getStoreById($storeId);
            
            $product = $this->productsRepository->createProduct($storeId, $vatIncluded, $quantity ?? 0);

            $this->productDetailService->createProductDetail($product->id, $languageId, $name, $description, $price, $currency);

        });

        return $product->load('details');

    }

    /**
     * Updates the product specified by the provided product id with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer $productId
     * @param integer $storeId
     * @param boolean|null $vatIncluded
     * @param integer|null $quantity
     * @return Product
     * 
     * @throws UnauthorizedAccessException If the specified product doesn't belong to the specified store.
     */
    public final function updateProduct(int $productId, int $storeId, ?bool $vatIncluded, ?int $quantity): Product {

        $this->storeService->getStoreById($storeId);
        
        if ($storeId != $this->getProductById($productId)->store_id) {
            throw new UnauthorizedAccessException("This product doesn't belong to this store");
        }

        return $this->productsRepository->updateProduct($productId, $vatIncluded, $quantity);
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

    /**
     * Deletes the specified product.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @return boolean
     */
    public final function deleteProduct(int $productId): bool {

        $this->getProductById($productId);

        return $this->productsRepository->deleteProduct($productId);
    }
}
