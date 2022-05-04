<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

/**
 * Tenant Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class TenantSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $plan
     * @param string[] $domains
     * @return void
     */
    public function run(string $plan, array $domains = []): Tenant {
        
        $tenant = Tenant::create(compact('plan'));

        foreach ($domains as $domain) {
            $tenant->domains()->create(compact('domain'));
        }

        return $tenant;
    }
}
