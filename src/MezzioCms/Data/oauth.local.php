<?php

declare(strict_types=1);

return [
    'authentication' => [
        'pdo' => [
            'dsn'      => 'mysql:dbname=' .getenv('DB_NAME'). ';host=' .getenv('DB_HOST'). ';charset=utf8',
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD')
        ],
    ]
];