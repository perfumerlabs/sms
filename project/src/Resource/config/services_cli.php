<?php

return [
    'sms.request' => [
        'class' => 'Perfumer\\Framework\\Proxy\\Request',
        'arguments' => ['$0', '$1', '$2', '$3', [
            'prefix' => 'Sms\\Command',
            'suffix' => 'Command'
        ]]
    ]
];
