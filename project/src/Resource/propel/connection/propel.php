<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'sms' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
                    'user' => 'PG_USER',
                    'password' => 'PG_PASSWORD',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES 'UTF8'"
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
