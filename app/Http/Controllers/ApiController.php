<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\{ Auth\Access\AuthorizesRequests, Bus\DispatchesJobs, Validation\ValidatesRequests };

/**
 * Abstract API Controller.
 * 
 * @api
 * @abstract
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
abstract class ApiController extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @since 1.0.0
     * @var GeneralService $generalService
     */
    protected GeneralService $generalService;

    /**
     * Creates a new ApiController instance.
     * 
     * @api
     * @since 1.1.0
     * @version 1.0.0
     */
    public function __construct() {
        // This is not injected in order to not forcing chlidren controllers to have it in their signatures.
        $this->generalService = app()->make(GeneralService::class);
    }

    /**
     * Converts the specified data array to a JSON response.
     * 
     * @final
     * @internal
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param mixed $data
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    protected final function getSuccessResponse($data, array $headers = [], int $options = 0): JsonResponse {
        return $this->generalService->getSuccessResponse($data, $headers, $options);
    }

    /**
     * Converts the specified error to a JSON response.
     * 
     * @final
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param mixed $error
     * @param integer $httpStatusCode
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    protected final function getErrorResponse($error, int $httpStatusCode, array $headers = [], int $options = 0): JsonResponse {
        return $this->generalService->getErrorResponse($error, $httpStatusCode, $headers, $options);
    }
}
