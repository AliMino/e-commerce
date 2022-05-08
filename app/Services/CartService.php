<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartsRepository;
use Illuminate\Support\{ Collection, Facades\DB };
use App\Exceptions\Api\{ InsufficientCartProductsException, InvalidCartQuantityException };

/**
 * Product's Cart Business Service.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class CartService {

    /**
     * @since 1.0.0
     * @var ProductService $productService
     */
    private ProductService $productService;
    
    /**
     * @since 1.0.0
     * @var ConsumerService $consumerService
     */
    private ConsumerService $consumerService;

    /**
     * @since 1.0.0
     * @var CartsRepository $cartsRepository
     */
    private CartsRepository $cartsRepository;

    /**
     * Creates a new CartService instance with the specified arguments.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param ProductService $productService
     * @param ConsumerService $consumerService
     * @param CartsRepository $cartsRepository
     */
    public final function __construct(
        ProductService $productService,
        ConsumerService $consumerService,
        CartsRepository $cartsRepository
    ) {
        $this->productService   = $productService;
        $this->consumerService  = $consumerService;
        $this->cartsRepository  = $cartsRepository;
    }

    /**
     * Adds the specified products to the shopping cart.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.1
     *
     * @param integer $consumerId
     * @param integer[][] $productsQuantities
     * @return void
     */
    public final function addToCart(int $consumerId, array $productsQuantities): void {
        
        DB::transaction(function() use ($consumerId, $productsQuantities) {
            
            $this->consumerService->getConsumer($consumerId);
            
            $productsIds = array_unique(array_column($productsQuantities, 'product_id'));
            
            $this->productService->assertProductsExistence(...$productsIds);
            $this->productService->assertProductsQuantitiesAvailability($productsQuantities);
            $this->assertPositiveNonZeroQuantities(array_column($productsQuantities, 'quantity'));
            
            /**
             * @var integer[][] $cartsToBeAdded
             * @var integer[][] $cartsToBeUpdated
             */
            $cartsToBeAdded = $cartsToBeUpdated = [];

            /** @var Cart $cart */
            foreach ($carts = $this->getCarts($consumerId, $productsIds) as $cart) {
                $cartsToBeUpdated[] = [
                    'product_id' => $cart->product_id,
                    'cart_id'    => $cart->id,
                    'quantity'   =>array_reduce(
                        array_column(array_filter(
                            $productsQuantities, fn(array $productQuantity) => $cart->product_id == $productQuantity['product_id']
                        ), 'quantity'),
                        fn(int $sum, int $quantity) => $sum + $quantity,
                        $cart->quantity
                    )
                ];
            }

            /** @var integer $productId */
            foreach (array_diff($productsIds, $carts->pluck('product_id')->toArray()) as $productId) {
                $cartsToBeAdded[] = [
                    'product_id' => $productId,
                    'quantity'   => array_reduce(
                        array_column(array_filter(
                            $productsQuantities, fn(array $productQuantity) => $productId == $productQuantity['product_id']
                        ), 'quantity'),
                        fn(int $sum, int $quantity) => $sum + $quantity,
                        0
                    )
                ];
            }

            if (0 < count($cartsToBeAdded)) {
                $this->cartsRepository->createCarts($consumerId, $cartsToBeAdded);
            }
            if (0 < count($cartsToBeUpdated)) {
                $this->cartsRepository->updateCarts($cartsToBeUpdated);
            }
            $this->productService->deductProductsQuantities($productsQuantities);

        });
    }

    /**
     * Removes the specified products from the shopping cart.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer $consumerId
     * @param integer[][] $productsQuantities
     * @return void
     * 
     * @throws InsufficientCartProductsException
     */
    public final function removeFromCart(int $consumerId, array $productsQuantities): void {

        DB::transaction(function() use ($consumerId, $productsQuantities) {
            
            $this->consumerService->getConsumer($consumerId);
                
            $productsIds = array_unique(array_column($productsQuantities, 'product_id'));

            $this->productService->assertProductsExistence(...$productsIds);
            $this->assertPositiveNonZeroQuantities(array_column($productsQuantities, 'quantity'));
            
            $carts = $this->getCarts($consumerId, $productsIds);
            if (count($productsQuantities) > $carts->count()) {
                throw new InsufficientCartProductsException();
            }
            $cartsToBeDeleted = $cartsToBeUpdated = [];
            foreach ($carts as $cart) {
                $quantityToBeRemoved = array_reduce(
                    array_column(array_filter(
                        $productsQuantities,
                        fn(array $productQuantity) => $productQuantity['product_id'] == $cart->product_id
                    ), 'quantity'),
                    fn(int $sum, int $quantity)=> $sum + $quantity,
                    0
                );
                
                if (0 > ($remainingQuantity = $cart->quantity - $quantityToBeRemoved)) {
                    $cartsToBeDeleted[] = $cart->product_id;
                } else {
                    $cartsToBeUpdated[] = [ 'cart_id' => $cart->id, 'quantity' => $remainingQuantity ];
                }
            }

            if (0 < count($cartsToBeUpdated)) {
                $this->cartsRepository->updateCarts($cartsToBeUpdated);
            }
            if (0 < count($cartsToBeDeleted)) {
                $this->cartsRepository->deleteCarts($cartsToBeDeleted);
            }
        });
    }

    /**
     * Retrieves a shopping cart items.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param integer $consumerId
     * @param integer[]|null $productsIds
     * @param boolean $withTotal
     * @return Collection
     */
    public final function getCarts(int $consumerId, ?array $productsIds = null, bool $withTotal = false): Collection {

        $this->consumerService->getConsumer($consumerId);

        $carts = $this->cartsRepository->getCarts($consumerId, $productsIds, $withTotal, $withTotal, $withTotal);

        return $withTotal ? collect([ 'carts' => $carts, 'totals' => $this->getCartsTotals($carts) ]) : $carts;
    }

    /**
     * Calculated te total cart price.
     * 
     * @internal
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param Collection $carts
     * @return float[]
     */
    private function getCartsTotals(Collection $carts): array {
        /** @var float[] $totals */
        $totals = [];
        
        /** @var Cart $cart */
        foreach ($carts as $cart) {
            $vatPercentage = (!$cart->product->vat_included) * $cart->product->store->vat_percentage;
            
            foreach ($cart->product->details as $productDetail) {
                $totals[ $productDetail->currency ] = 
                    ($totals[ $productDetail->currency ] ?? 0) + 
                    (($cart->quantity + $vatPercentage) * $productDetail->price) +
                    $productDetail->shipping_cost ?? 0;
            }
        }

        return $totals;
    }

    /**
     * Asserts that the specified quantities are positive non-zero integers.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param integer[] $quantities
     * @return void
     * 
     * @throws InvalidCartQuantityException
     */
    private function assertPositiveNonZeroQuantities(array $quantities): void {
        if (count($quantities) != count($integerQuantities = array_filter($quantities, 'is_int'))) {
            throw new InvalidCartQuantityException();
        }
        
        if (0 >= min($integerQuantities)) {
            throw new InvalidCartQuantityException();
        }
    }
}
