<?php

use EmailMarketing\Application\Action\Cliente\ClienteCreatePageAction;
use EmailMarketing\Application\Action\Cliente\Factory\ClienteCreatePageFactory;
use EmailMarketing\Application\Action\Cliente\ClienteListPageAction;
use EmailMarketing\Application\Action\Cliente\Factory\ClienteListPageFactory;
use EmailMarketing\Application\Action\HomePageAction;
use EmailMarketing\Application\Action\HomePageFactory;
use EmailMarketing\Application\Action\PingAction;
use EmailMarketing\Application\Action\TestePageAction;
use EmailMarketing\Application\Action\TestePageFactory;
use Zend\Expressive\Router\AuraRouter;
use Zend\Expressive\Router\RouterInterface;

return [
    'dependencies' => [
        'invokables' => [
            RouterInterface::class => AuraRouter::class,
            PingAction::class => PingAction::class,
        ],
        'factories' => [
            HomePageAction::class => HomePageFactory::class,
            TestePageAction::class => TestePageFactory::class,
            ClienteListPageAction::class => ClienteListPageFactory::class,
            ClienteCreatePageAction::class => ClienteCreatePageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'cliente.list',
            'path' => '/admin/clientes',
            'middleware' => ClienteListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'cliente.create',
            'path' => '/admin/cliente/create',
            'middleware' => ClienteCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
    ],
];
