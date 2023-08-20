<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [

        'super_admin'=>[
            'countries'=>'c,r,u,d',
            'admins'=>'c,r,u,d',
            'roles'=>'c,r,u,d',
            'users'=>'c,r,u,d',


            'settings' => 'r,u',


        ]

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
