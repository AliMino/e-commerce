<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use App\Constants\{ Languages, Roles };
use App\Models\{Language, Product, ProductDetail, Role, Store, Tenant, User };

/**
 * Database Seeder.
 * 
 * @api
 * @final
 * @version 1.3.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class DatabaseSeeder extends Seeder {

    private Generator $faker;

    /**
     * Seed the application's database.
     * 
     * @api
     * @since 1.0.0
     * @version 1.1.0
     *
     * @return void
     */
    public function run() {
        $this->faker = \Faker\Factory::create();

        foreach (config('seeding.data.subDomains') as $subDomain) {
            $this->seedTenant($this->faker->word, $subDomain);
        }
    }

    /**
     * Seeds a new tenant.
     * 
     * @internal
     * @since 1.0.0
     * @version 1.2.0
     *
     * @param string $plan
     * @param string ...$domains
     * @return \App\Models\Tenant
     */
    private function seedTenant(string $plan, string ...$domains): Tenant {
        $this->call(TenantSeeder::class, false, compact('plan', 'domains'));

        $tenant = Tenant::orderBy('id', 'desc')->first();

        $this->seedLanguages($tenant);

        foreach (config('seeding.data.user_roles') as $userRoleName) {
            $this->seedRole($tenant, $userRoleName);
        }

        return $tenant;
    }

    /**
     * Seeds the pre-specified languages to the specified tenant.
     * 
     * @internal
     * @since 1.2.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @return void
     */
    private function seedLanguages(Tenant $tenant): void {

        foreach (Languages::ALL as $code => $name) {

            $this->call(LanguageSeeder::class, false, compact('tenant', 'name', 'code'));

        }
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
     * @version 1.2.0
     *
     * @param Tenant $tenant
     * @param Role $role
     * @return User
     */
    private function seedUser(Tenant $tenant, Role $role): User {
        $this->call(UserSeeder::class, false, [
            'tenant'    => $tenant,
            'name'      => $this->faker->name,
            'email'     => "$role->name@localhost.com",
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
     * @version 1.1.0
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

        $store = $tenant->run(fn() => Store::orderBy('id', 'desc')->first());

        $englishLanguage = $tenant->run(fn() => Language::where('code', Languages::ENGLISH_CODE)->first());

        $this->seedProduct($tenant, $englishLanguage, true, 5, $store);
        $this->seedProduct($tenant, $englishLanguage, false, 5, $store);

        return $store;
    }

    /**
     * Seeds a new product.
     *
     * @internal
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param Language $language
     * @param boolean $vatIncluded
     * @param integer $currentQuantity
     * @param Store $store
     * @return Product
     */
    private function seedProduct(Tenant $tenant, Language $language, bool $vatIncluded, int $currentQuantity, Store $store): Product {
        $this->call(ProductSeeder::class, false, [
            'vat_included' => $vatIncluded,
            'current_quantity' => $currentQuantity,
            'store' => $store,
            'tenant' => $tenant
        ]);

        $product = $tenant->run(fn() => Product::orderBy('id', 'desc')->first());

        $this->seedProductDetails($tenant, $product, $language, $this->faker->name, null, $this->faker->randomFloat(2, 0, 10000), 'EGP', $this->faker->randomElement([ null, 10, 50 ]));

        $tenant->run(function() use (&$product) { $product->load('details'); });
        
        return $product;
    }

    /**
     * Seeds a new product detail.
     * 
     * @internal
     * @since 1.3.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param Product $product
     * @param Language $language
     * @param string $name
     * @param string|null $description
     * @param float $price
     * @param string $currency
     * @param float|null $shippingCost
     * @return ProductDetail
     */
    private function seedProductDetails(Tenant $tenant, Product $product, Language $language, string $name, ?string $description, float $price, string $currency, ?float $shippingCost): ProductDetail {
        $this->call(ProductDetailSeeder::class, false, compact(
            'tenant', 'product', 'language', 'name', 'description', 'price', 'currency', 'shippingCost'
        ));

        return $tenant->run(fn() => ProductDetail::orderBy('id', 'desc')->first());
    }
}
