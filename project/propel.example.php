<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'sms' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=db;port=5432;dbname=sms',
                    'user' => 'postgres',
                    'password' => 'postgres',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES 'UTF8'",
                            'schema' => "SET search_path TO public"
                        ]
                    ],
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'sms',
            'connections' => ['sms']
        ],
        'generator' => [
            'defaultConnection' => 'sms',
            'connections' => ['sms']
        ]
    ]
];
