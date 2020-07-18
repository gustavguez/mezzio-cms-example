<?php

declare(strict_types=1);

use Zend\Expressive\Authentication;
use League\OAuth2\Server\Grant;

return [
    'dependencies' => [
        'aliases' => [
            Authentication\AuthenticationInterface::class => Authentication\OAuth2\OAuth2Adapter::class,
        ],
    ],
    'authentication' => [
        'private_key'    => __DIR__ . '/../../data/oauth/private.key',
        'public_key'     => __DIR__ . '/../../data/oauth/public.key',
        'encryption_key' => require __DIR__ . '/../../data/oauth/encryption.key',
        'pdo' => [
            'dsn'      => 'mysql:dbname=' .getenv('DB_NAME'). ';host=' .getenv('DB_HOST'). ';charset=utf8',
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD')
        ],
        // Set value to null to disable a grant
        'grants' => [
            Grant\PasswordGrant::class  => Grant\PasswordGrant::class
        ]
    ]
];