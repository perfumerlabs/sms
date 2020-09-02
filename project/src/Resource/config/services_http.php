<?php

return [
    'fast_router' => [
        'shared' => true,
        'init' => function(\Perfumer\Component\Container\Container $container) {
            return \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
                $r->addRoute('POST', '/sms', 'sms.post');
                $r->addRoute('GET', '/blacklist/{phone}', 'blacklist.get');
                $r->addRoute('POST', '/blacklist', 'blacklist.post');
                $r->addRoute('DELETE', '/blacklist/{phone}', 'blacklist.delete');
            });
        }
    ],

    'sms.router' => [
        'shared' => true,
        'class' => 'Perfumer\\Framework\\Router\\Http\\FastRouteRouter',
        'arguments' => ['#gateway.http', '#fast_router', [
            'data_type' => 'json',
            'allowed_actions' => ['get', 'post', 'delete'],
        ]]
    ],

    'sms.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Sms\\Controller',
            'suffix' => 'Controller'
        ]]
    ]
];
