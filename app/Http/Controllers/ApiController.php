<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract API Controller.
 * 
 * @api
 * @abstract
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
abstract class ApiController extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Converts the specified data array to a JSON response.
     * 
     * @final
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param mixed[] $data
     * @param integer $httpStatusCode
     * @param string[] $headers
     * @param integer $options
     * @return JsonResponse
     */
    protected final function apiResponse(array $data, int $httpStatusCode = Response::HTTP_OK, array $headers = [], int $options = 0): JsonResponse {
        return response()->json($data, $httpStatusCode, $headers, $options);
    }
}
