<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use App\Models\{ Role, Tenant, User };

/**
 * Database Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class DatabaseSeeder extends Seeder {

    private Generator $faker;

    /**
     * Seed the application's database.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return void
     */
    public function run() {
        $this->faker = \Faker\Factory::create();

        for ($i = 0; $i < config('seeding.arguments.number_of_tenants'); $i++) {
            $this->seedTenant($this->faker->word, $this->faker->domainWord);
        }
    }

    private function seedTenant(string $plan, string ...$domains): Tenant {
        $this->call(TenantSeeder::class, false, compact('plan', 'domains'));

        $tenant = Tenant::orderBy('id', 'desc')->first();

        foreach (config('seeding.data.user_roles') as $userRoleName) {
            $this->seedRole($tenant, $userRoleName);
        }

        return $tenant;
    }

    private function seedRole(Tenant $tenant, string $roleName): Role {
        $this->call(RoleSeeder::class, false, [ 'tenant' => $tenant, 'name' => $roleName ]);

        $role = $tenant->run(fn() => Role::orderBy('id', 'desc')->first());

        for ($i = 0; $i < config('seeding.arguments.number_of_users_per_role'); $i++) {
            $this->seedUser($tenant, $role);
        }

        return $role;
    }

    private function seedUser(Tenant $tenant, Role $role): User {
        $this->call(UserSeeder::class, false, [
            'tenant'    => $tenant,
            'name'      => $this->faker->name,
            'email'     => $this->faker->email,
            'password'  => config('seeding.data.user_password'),
            'role'      => $role
        ]);

        return $tenant->run(fn() => User::orderBy('id', 'desc')->first());
    }
}
