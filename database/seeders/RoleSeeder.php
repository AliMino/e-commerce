<?php

namespace Database\Seeders;

use App\Models\{ Role, Tenant };
use Illuminate\Database\Seeder;

/**
 * Role Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class RoleSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param string $name
     * @return void
     */
    public function run(Tenant $tenant, string $name) {
        
        return $tenant->run(function() use ($name) {

            return Role::create(compact('name'));

        });

    }
}
