<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\{ Base\ApiRequest, Store\Product\Cart\UpdateCartRequest };

/**
 * Cart Controller.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CartController extends ApiController {

    /**
     * @since 1.0.0
     * @var CartService $cartService
     */
    private CartService $cartService;

    /**
     * Creates a new CartController instance on top of the specified CartService instance.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param CartService $cartService
     */
    public final function __construct(CartService $cartService) {
        parent::__construct();
        $this->cartService = $cartService;
    }

    /**
     * Adds product(s) to a shopping cart.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param UpdateCartRequest $request
     * @return JsonResponse
     */
    public final function addToCart(UpdateCartRequest $request): JsonResponse {
        $this->cartService->addToCart($request->user()->id, $request->input());
        return $this->getSuccessResponse(true);
    }

    /**
     * Removes product(s) from a shopping cart.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param UpdateCartRequest $request
     * @return JsonResponse
     */
    public final function removeFromCart(UpdateCartRequest $request): JsonResponse {
        $this->cartService->removeFromCart($request->user()->id, $request->input());
        return $this->getSuccessResponse(true);
    }

    /**
     * Retrieves a shopping cart.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param ApiRequest $request
     * @return JsonResponse
     */
    public final function getCart(ApiRequest $request): JsonResponse {
        return $this->getSuccessResponse($this->cartService->getCarts($request->user()->id));
    }
}

