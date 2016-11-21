<?php

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\User;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'homestead',
                    'password' => 'secret',
                    'dbname' => 'emailmarketing',
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ],
                ],
            ]
        ],
        'driver' => [
            'EmailMarketing_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../src/EmailMarketing/Infrastructure/Persistence/Doctrine/ORM'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'EmailMarketing\Domain\Entity' => 'EmailMarketing_driver'
                ]
            ]
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => EntityManager::class,
                'identity_class' => User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function (User $user, $passwordGiven) {
                    return password_verify($passwordGiven, $user->getPassword());
                },
            ],
        ],
    ]
];
