<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            EmailMarketing\Action\PingAction::class => EmailMarketing\Action\PingAction::class,
        ],
        'factories' => [
            EmailMarketing\Action\HomePageAction::class => EmailMarketing\Action\HomePageFactory::class,
            EmailMarketing\Action\TestePageAction::class => EmailMarketing\Action\TestePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => EmailMarketing\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => EmailMarketing\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => EmailMarketing\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
