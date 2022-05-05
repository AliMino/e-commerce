<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * General Service.
 * 
 * A collection of helper methods used to reduce
 * the inclusion of library classes into the business service layer.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class GeneralService {

    /**
     * Converts the specified data array to a JSON response.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param mixed $data
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    public final function getSuccessResponse($data, array $headers = [], int $options = 0): JsonResponse {
        return $this->getApiResponse([ 'status' => true,  'data' => $data, 'error' => null ], Response::HTTP_OK, $headers, $options);
    }

    /**
     * Converts the specified error to a JSON response.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param mixed $error
     * @param integer $httpStatusCode
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    public final function getErrorResponse($error, int $httpStatusCode, array $headers = [], int $options = 0): JsonResponse {
        return $this->getApiResponse([ 'status' => false, 'data' => null, 'error' => $error ], $httpStatusCode,   $headers, $options);
    }

    /**
     * Hashes the specified string.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $string
     * @return string
     */
    public final function hash(string $string): string {
        return Hash::make($string);
    }

    /**
     * Checks whether the specified string matches the specified hash, or not.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param string $string
     * @param string $hash
     * @return boolean
     */
    public final function checkHash(string $string, string $hash): bool {
        return Hash::check($string, $hash);
    }

    /**
     * Converts the specified data to a JSON response.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param mixed $data
     * @param integer $httpStatusCode
     * @param string[] $headers
     * @param integer $options
     * @return JsonResponse
     */
    private function getApiResponse($data, int $httpStatusCode = Response::HTTP_OK, array $headers = [], int $options = 0): JsonResponse {
        return response()->json($data, $httpStatusCode, $headers, $options);
    }
}
