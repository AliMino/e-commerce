<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Store\Product\{ CreateProductRequest, GetProductsRequest, UpdateProductRequest };

/**
 * Product Controller.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductController extends ApiController {

    /**
     * @since 1.0.0
     * @var ProductService $productService
     */
    private ProductService $productService;

    /**
     * Creates a new ProductController instance on top of the provided ProductService instance.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param ProductService $productService
     */
    public final function __construct(ProductService $productService) {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * Gets the products in the store specified by the provided store id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param GetProductsRequest $request
     * @param integer $storeId
     * @return JsonResponse
     */
    public final function getStoreProducts(GetProductsRequest $request, int $storeId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->getProducts(
                $storeId,
                $request->input('having_quantity_more_than')
            )
        );
    }

    /**
     * Creates a new product at the store specified by the provided store id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param CreateProductRequest $request
     * @param integer $storeId
     * @return JsonResponse
     */
    public final function createStoreProduct(CreateProductRequest $request, int $storeId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->createProduct(
                $storeId,
                $request->input('name'),
                $request->input('description'),
                $request->input('price'),
                $request->input('vat_included'),
                $request->input('quantity')
            )
        );
    }

    /**
     * Updates the product specified by the provided product id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param UpdateProductRequest $request
     * @param integer $storeId
     * @param integer $productId
     * @return JsonResponse
     */
    public final function updateStoreProduct(UpdateProductRequest $request, int $storeId, int $productId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->updateProduct(
                $productId,
                $storeId,
                $request->input('name'),
                $request->input('description'),
                $request->input('price'),
                $request->input('vat_included'),
                $request->input('quantity')
            )
        );
    }
}
