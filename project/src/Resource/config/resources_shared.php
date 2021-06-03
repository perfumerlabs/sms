<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'sms',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
        'db_schema'     => 'PG_SCHEMA',
        'db_user'       => 'PG_USER',
        'db_password'   => 'PG_PASSWORD',
        'platform'      => 'pgsql',
        'config_dir'    => 'src/Resource/propel/connection',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
        'migration_table' => 'sms_propel_migration',
    ],
    'pg' => [
        'real_host' => 'PG_REAL_HOST',
        'host' => 'PG_HOST',
        'port' => 'PG_PORT',
        'database' => 'PG_DATABASE',
        'schema' => 'PG_SCHEMA',
        'user' => 'PG_USER',
        'password' => 'PG_PASSWORD',
    ],
    'sms' => [
        'provider' => 'SMS_PROVIDER',
        'dummy' => 'SMS_DUMMY',
    ],
    'smscru' => [
        'username' => 'SMSCRU_USERNAME',
        'password' => 'SMSCRU_PASSWORD',
        'sender' => 'SMSCRU_SENDER',
    ],
];
