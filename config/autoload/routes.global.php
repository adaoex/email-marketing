<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            EmailMarketing\Application\Action\PingAction::class => EmailMarketing\Application\Action\PingAction::class,
        ],
        'factories' => [
            EmailMarketing\Application\Action\HomePageAction::class => EmailMarketing\Application\Action\HomePageFactory::class,
            EmailMarketing\Application\Action\TestePageAction::class => EmailMarketing\Application\Action\TestePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => EmailMarketing\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => EmailMarketing\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => EmailMarketing\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
