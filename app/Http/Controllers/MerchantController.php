<?php

namespace App\Http\Controllers;

use App\Services\MerchantService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\{ AuthenticationRequest, CreateMerchantRequest };

/**
 * Merchant Controller.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class MerchantController extends ApiController {

    /**
     * @since 1.0.0
     * @var MerchantService $merchantService
     */
    private MerchantService $merchantService;

    /**
     * Creates a new MerchantController instance with the specified MerchantService.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param MerchantService $merchantService
     */
    public final function __construct(MerchantService $merchantService) {
        parent::__construct();
        $this->merchantService = $merchantService;
    }

    /**
     * Creates a new Merchant.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param CreateMerchantRequest $request
     * @return JsonResponse
     */
    public final function createMerchant(CreateMerchantRequest $request): JsonResponse {
        return $this->getSuccessResponse(
            $this->merchantService->createMerchant(
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('store_name'),
                $request->input('store_vat_percentage')
            )
        );
    }

    /**
     * Authenticate a merchant.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param AuthenticationRequest $request
     * @return JsonResponse
     */
    public final function authenticateMerchant(AuthenticationRequest $request): JsonResponse {
        return $this->getSuccessResponse(
            $this->merchantService->authenticateMerchant(
                $request->input('email'),
                $request->input('password')
            )
        );
    }
}
