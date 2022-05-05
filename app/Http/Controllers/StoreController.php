<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateStoreRequest;

/**
 * Store Controller.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class StoreController extends ApiController {

    /**
     * @since 1.0.0
     * @var StoreService $storeService
     */
    private StoreService $storeService;

    /**
     * Creates a new StoreController instance with the specified StoreService instance.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param StoreService $storeService
     */
    public final function __construct(StoreService $storeService) {
        parent::__construct();
        $this->storeService = $storeService;
    }

    /**
     * Updates the store specified by the provided store id.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param UpdateStoreRequest $request
     * @param integer $storeId
     * @return JsonResponse
     */
    public final function updateStore(UpdateStoreRequest $request, int $storeId): JsonResponse {
        return $this->getSuccessResponse(
            $this->storeService->updateStore(
                $storeId,
                $request->input('new_name')
            )
        );
    }
}
