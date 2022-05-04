<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

/**
 * The Tenant Model.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Tenant extends BaseTenant implements TenantWithDatabase {

    use HasDatabase, HasDomains;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @since 1.0.0
     * @var string[] $hidden
     */
    protected $hidden = [
        'tenancy_db_name',
    ];

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @return bool
     */
    public final function getIncrementing() {
        return true;
    }
}
