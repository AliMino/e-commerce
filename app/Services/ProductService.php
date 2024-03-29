<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use App\Models\{ Product, ProductDetail };
use Illuminate\Support\{ Collection, Facades\DB };
use App\Exceptions\Api\{ EntityNotFoundException, InsufficientProductsException, ProductDetailAlreadyExistsException, ProductNotFoundException, UnauthorizedAccessException };

/**
 * Product Business Service.
 * 
 * @api
 * @final
 * @version 1.4.0
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
     * @version 3.0.0
     *
     * @param integer|null $storeId
     * @param integer|null $quantityThreshold
     * @param boolean $withDetails
     * @return Collection
     */
    public final function getProducts(?int $storeId, ?int $quantityThreshold, bool $withDetails): Collection {
        
        $this->storeService->getStoreById($storeId);

        $products = $this->productsRepository->getProducts($storeId, $quantityThreshold);

        return $withDetails ? $products->load('details') : $products;
    }

    /**
     * Creates a new product with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 2.0.0
     *
     * @param integer $storeId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param boolean $vatIncluded
     * @param integer|null $quantity
     * @param float|null $shippingCost
     * @return Product
     */
    public final function createProduct(int $storeId, string $name, ?string $description, float $price, int $languageId, string $currency, bool $vatIncluded, ?int $quantity, ?float $shippingCost): Product {
        
        /** @var Product|null $product */
        $product = null;
        
        DB::transaction(function() use ($storeId, &$product, $name, $description, $price, $languageId, $currency , $vatIncluded, $quantity, $shippingCost) {
            
            $this->storeService->getStoreById($storeId);
            
            $product = $this->productsRepository->createProduct($storeId, $vatIncluded, $quantity ?? 0);

            $this->productDetailService->createProductDetail($product->id, $languageId, $name, $description, $price, $currency, $shippingCost);

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
     * @version 1.1.0
     *
     * @param integer $productId
     * @param integer|null $storeId
     * @param boolean $withDetails
     * @return Product
     * 
     * @throws EntityNotFoundException
     */
    public final function getProductById(int $productId, ?int $storeId = null, bool $withDetails = false): Product {
        if (is_null($product = $this->productsRepository->findProduct($productId, $storeId, $withDetails))) {
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

    /**
     * Asserts that the products specified by the provided products IDs are all exist.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer ...$productsIds
     * @return void
     */
    public final function assertProductsExistence(int ...$productsIds): void {
        if (count($productsIds) != $this->productsRepository->getProductsCount($productsIds)) {
            throw new ProductNotFoundException();
        }
    }

    /**
     * Asserts that the specified products' quantities are available.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param integer[] $productsQuantities
     * @param boolean $lockForUpdate
     * @return void
     */
    public final function assertProductsQuantitiesAvailability(array $productsQuantities, bool $lockForUpdate = true): void {
        if (count(array_unique(array_column($productsQuantities, 'product_id')))
            > $this->productsRepository->getSufficientProductsCount($productsQuantities, $lockForUpdate)) {
            throw new InsufficientProductsException();
        }
    }

    /**
     * Deduct the specified products quantities from the available stock.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.1.0
     *
     * @param integer[][] $productsQuantities
     * @return integer
     */
    public final function deductProductsQuantities(array $productsQuantities): int {
        $products = $this->getProductsByIds(array_unique(array_column($productsQuantities, 'product_id')));
        $newQuantities = [];
       
        foreach ($productsQuantities as $productQuantity) {
            $newQuantities[] = [
                'product_id' => $id = $productQuantity[ 'product_id' ],
                'quantity'   => $products->where('id', $id)->first()->current_quantity - $productQuantity[ 'quantity' ]
            ];
        }

        return $this->productsRepository->updateProductsQuantities($newQuantities);
    }

    /**
     * Creates a new product detail with the specified details.
     * 
     * @api
     * @final
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param integer $productId
     * @param integer $storeId
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param integer $languageId
     * @param string $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     * 
     * @throws ProductDetailAlreadyExistsException
     */
    public final function createProductDetail(int $productId, int $storeId, string $name, ?string $description, float $price, int $languageId, string $currency, ?float $shippingCost): ProductDetail {
        $product = $this->getProductById($productId, $storeId, true);

        if ($product->details->pluck('language_id')->contains($languageId)) {
            throw new ProductDetailAlreadyExistsException($productId, $languageId);
        }

        return $this->productDetailService->createProductDetail($productId, $languageId, $name, $description, $price, $currency, $shippingCost);
    }

    /**
     * Updates the specified product detail.
     * 
     * @api
     * @final
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param integer $productDetailId
     * @param integer $productId
     * @param integer $storeId
     * @param string|null $name
     * @param string|null $description
     * @param float|null $price
     * @param integer|null $languageId
     * @param string|null $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     */
    public final function updateProductDetail(int $productDetailId, int $productId, int $storeId, ?string $name, ?string $description, ?float $price, ?int $languageId, ?string $currency, ?float $shippingCost): ProductDetail {
        
        $this->getProductById($productId, $storeId, true);
        
        return $this->productDetailService->updateProductDetail($productDetailId, $productId, $name, $description, $price, $languageId, $currency, $shippingCost);
    }

    /**
     * Retrieves products by their IDs.
     * 
     * @api
     * @final
     * @since 1.4.0
     * @version 1.0.0
     *
     * @param integer[] $productsIds
     * @return Collection
     */
    public final function getProductsByIds(array $productsIds): Collection {
        return $this->productsRepository->getProductsByIds($productsIds);
    }
}
