<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Store\Product\{ CreateProductRequest, GetProductsRequest, UpdateProductRequest };
use App\Http\Requests\Store\Product\Details\{ CreateProductDetailRequest, UpdateProductDetailRequest };

/**
 * Product Controller.
 * 
 * @api
 * @final
 * @version 1.3.0
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
     * @version 1.1.0
     *
     * @param GetProductsRequest $request
     * @param integer $storeId
     * @return JsonResponse
     */
    public final function getStoreProducts(GetProductsRequest $request, int $storeId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->getProducts(
                $storeId,
                $request->input('having_quantity_more_than'),
                $request->input('with_details', false)
            )
        );
    }

    /**
     * Creates a new product at the store specified by the provided store id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.2.0
     *
     * @param CreateProductRequest $request
     * @param integer $storeId
     * @return JsonResponse
     */
    public final function createStoreProduct(CreateProductRequest $request, int $storeId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->createProduct(
                $storeId,
                $request->input('details.name'),
                $request->input('details.description'),
                $request->input('details.price'),
                $request->input('details.language_id'),
                $request->input('details.currency'),
                $request->input('vat_included'),
                $request->input('quantity'),
                $request->input('details.shipping_cost'),
            )
        );
    }

    /**
     * Updates the product specified by the provided product id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
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
                $request->input('vat_included'),
                $request->input('quantity')
            )
        );
    }

    /**
     * Creates a new product detail.
     * 
     * @api
     * @final
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param CreateProductDetailRequest $request
     * @param integer $storeId
     * @param integer $productId
     * @return JsonResponse
     */
    public final function createProductDetail(CreateProductDetailRequest $request, int $storeId, int $productId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->createProductDetail(
                $productId,
                $storeId,
                $request->input('name'),
                $request->input('description'),
                $request->input('price'),
                $request->input('language_id'),
                $request->input('currency'),
                $request->input('shipping_cost')
            )
        );
    }

    /**
     * Updates the specified product detail.
     * 
     * @api
     * @final
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param UpdateProductDetailRequest $request
     * @param integer $storeId
     * @param integer $productId
     * @param integer $productDetailId
     * @return JsonResponse
     */
    public final function updateProductDetail(UpdateProductDetailRequest $request, int $storeId, int $productId, int $productDetailId): JsonResponse {
        return $this->getSuccessResponse(
            $this->productService->updateProductDetail(
                $productDetailId,
                $productId,
                $storeId,
                $request->input('name'),
                $request->input('description'),
                $request->input('price'),
                $request->input('language_id'),
                $request->input('currency'),
                $request->input('shipping_cost')
            )
        );
    }
}
