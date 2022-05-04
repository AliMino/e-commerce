<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\{ Request, JsonResponse };

/**
 * User Controller.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UserController extends ApiController {
    
    /**
     * Creates a new user.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function createUser(Request $request): JsonResponse {
        return $this->apiResponse([
            'user' => User::create([ 'name' => $request->input('name'), 'email' => $request->input('email'), 'password' => $request->input('password') ])
        ]);
    }

    /**
     * Authenticate user.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function authenticateUser(Request $request): JsonResponse {
        return $this->apiResponse([
            'token' => User::where('name', $request->input('name'))->first()->createToken('token-name')->plainTextToken
        ]);
    }

    /**
     * Gets the logged-in user's profile.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function getLoggedInUser(Request $request): JsonResponse {
        return $this->apiResponse([ 'user' => $request->user() ]);
    }
}
