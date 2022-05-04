<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Role, Tenant, User };

/**
 * User Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param Tenant $tenant
     * @param string $name
     * @param string $email
     * @param string $password
     * @param Role $role
     * @return void
     */
    public function run(Tenant $tenant, string $name, string $email, string $password, Role $role): User {
        
        return $tenant->run(function() use ($name, $email, $password, $role) {
            
            $password = Hash::make($password);
            $role_id  = $role->id;
            
            return User::create(compact('name', 'email', 'password', 'role_id'));
        });

    }
}
