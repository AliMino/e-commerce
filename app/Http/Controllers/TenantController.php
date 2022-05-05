<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\{ Request, JsonResponse };

/**
 * Tenant Controller.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class TenantController extends ApiController {

    /**
     * Creates a new tenant with their default domain.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param Request $request
     * @return JsonResponse
     */
    public final function createTenant(Request $request): JsonResponse {
        $tenant = Tenant::create([
            'plan' => $request->input('plan', 'free')
        ]);

        $tenant->domains()->create([ 'domain' => $request->input('domain') ]);

        return $this->getSuccessResponse($tenant);
    }

    /**
     * Gets the current tenant.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.1.0
     *
     * @return JsonResponse
     */
    public final function getCurrentTenant(): JsonResponse {
        return $this->getSuccessResponse(tenant());
    }
}
