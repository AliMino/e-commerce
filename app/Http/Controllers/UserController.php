<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\{ Request, JsonResponse };

/**
 * User Controller.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UserController extends ApiController {

    /**
     * Authenticate user.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function authenticateUser(Request $request): JsonResponse {
        return $this->getSuccessResponse(
            User::where('name', $request->input('name'))->first()->createToken('token-name')->plainTextToken
        );
    }

    /**
     * Gets the logged-in user's profile.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function getLoggedInUser(Request $request): JsonResponse {
        return $this->getSuccessResponse($request->user());
    }
}
