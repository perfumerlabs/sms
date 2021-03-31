<?php

return [
    'gateway' => [
        'shared' => true,
        'class' => 'Project\\Gateway',
        'arguments' => ['#application', '#gateway.http', '#gateway.console']
    ],

    'provider.smscru' => [
        'shared' => true,
        'class' => 'Sms\\Service\\SmscRuProvider',
        'arguments' => ['@smscru/sender', '@smscru/username', '@smscru/password', '@sms/dummy']
    ],

    'propel.connection_manager' => [
        'class' => 'Propel\\Runtime\\Connection\\ConnectionManagerSingle',
        'after' => function(\Perfumer\Component\Container\Container $container, \Propel\Runtime\Connection\ConnectionManagerSingle $connection_manager) {
            $configuration = [
                'dsn' => $container->getParam('propel/dsn'),
                'user' => $container->getParam('propel/db_user'),
                'password' => $container->getParam('propel/db_password'),
                'settings' => [
                    'charset' => 'utf8',
                ]
            ];

            $schema = $container->getParam('propel/db_schema');

            if ($schema !== 'public' && $schema !== null) {
                $configuration['settings']['queries'] = [
                    'schema' => "SET search_path TO " . $schema
                ];
            }

            $connection_manager->setConfiguration($configuration);
        }
    ],
];