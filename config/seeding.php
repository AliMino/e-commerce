<?php

/**
 * Seeding arguments and data.
 * 
 * @internal
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 * @see \Database\Seeders\DatabaseSeeder
 */

return [

    'arguments' => [

        'number_of_tenants' => 2,

        'number_of_users_per_role' => 1

    ],

    'data' => [

        'subDomains' => [

            'domain1',
            'domain2'

        ],

        'user_password' => '1234',

        'user_roles' => [

            App\Constants\Roles::MERCHANT,
            App\Constants\Roles::CONSUMER

        ]

    ]

];
