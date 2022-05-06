<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Language, Tenant };

/**
 * Language Seeder.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class LanguageSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * @api
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return Language
     */
    public function run(Tenant $tenant, string $name, string $code): Language {
        
        return $tenant->run(function() use ($name, $code) {

            return Language::create(compact('name', 'code'));

        });

    }
}
