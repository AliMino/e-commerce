<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Constants\Roles;
use Illuminate\Database\Seeder;
use App\Models\{ Role, Store, Tenant, User };

/**
 * Database Seeder.
 * 
 * @api
 * @final
 * @version 1.1.0
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

    /**
     * Seeds a new tenant.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $plan
     * @param string ...$domains
     * @return \App\Models\Tenant
     */
    private function seedTenant(string $plan, string ...$domains): Tenant {
        $this->call(TenantSeeder::class, false, compact('plan', 'domains'));

        $tenant = Tenant::orderBy('id', 'desc')->first();

        foreach (config('seeding.data.user_roles') as $userRoleName) {
            $this->seedRole($tenant, $userRoleName);
        }

        return $tenant;
    }

    /**
     * Seeds a new user-role for the specified tenant.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param string $roleName
     * @return Role
     */
    private function seedRole(Tenant $tenant, string $roleName): Role {
        $this->call(RoleSeeder::class, false, [ 'tenant' => $tenant, 'name' => $roleName ]);

        $role = $tenant->run(fn() => Role::orderBy('id', 'desc')->first());

        for ($i = 0; $i < config('seeding.arguments.number_of_users_per_role'); $i++) {
            $this->seedUser($tenant, $role);
        }

        return $role;
    }

    /**
     * Seeds a new user.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param Tenant $tenant
     * @param Role $role
     * @return User
     */
    private function seedUser(Tenant $tenant, Role $role): User {
        $this->call(UserSeeder::class, false, [
            'tenant'    => $tenant,
            'name'      => $this->faker->name,
            'email'     => $this->faker->email,
            'password'  => config('seeding.data.user_password'),
            'role'      => $role
        ]);

        $user = $tenant->run(fn() => User::orderBy('id', 'desc')->first());

        if (Roles::MERCHANT == $role->name) {
            $this->seedStore($tenant, $this->faker->streetName, $user);
        }

        return $user;
    }

    /**
     * Seeds a new store.
     * 
     * @internal
     * @since 1.1.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param string $storeName
     * @param User $merchant
     * @return Store
     */
    private function seedStore(Tenant $tenant, string $storeName, User $merchant): Store {
        $this->call(StoreSeeder::class, false, [
            'tenant'   => $tenant,
            'name'     => $storeName,
            'merchant' => $merchant
        ]);

        return $tenant->run(fn() => Store::orderBy('id', 'desc')->first());;
    }
}
