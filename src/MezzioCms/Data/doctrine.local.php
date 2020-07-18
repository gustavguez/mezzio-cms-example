<?php
return [
    'dependencies' => [
        'factories' => [
            'doctrine.entity_manager.orm_default' => \Roave\PsrContainerDoctrine\EntityManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'url' => 'mysql://' .getenv('DB_USERNAME'). ':' .getenv('DB_PASSWORD'). '@' .getenv('DB_HOST'). '/' .getenv('DB_NAME'),
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'Gustavguez\MezzioCms' => 'my_entity',
                ],
            ],
            'my_entity' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/../../src/App/src/Domain',
            ],
        ],
    ],
];