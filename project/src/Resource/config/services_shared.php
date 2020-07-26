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
    ]
];