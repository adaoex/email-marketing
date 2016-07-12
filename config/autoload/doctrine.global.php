<?php

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
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ],
                ],
            ]
        ],
        'driver' => [
            'EmailMarketing_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../src/EmailMarketing/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'EmailMarketing\Entity' => 'EmailMarketing_driver'
                ]
            ]
        ]
    ]
];
