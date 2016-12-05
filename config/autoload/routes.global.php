<?php

use EmailMarketing\Application\Action\{
    Cliente,
    Contato,
    Tag,
    HomePageAction,
    HomePageFactory,
    LoginPageAction,
    LoginPageFactory,
    LogoutAction,
    LogoutFactory,
    PingAction,
    TestePageAction,
    TestePageFactory
};

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
            LoginPageAction::class => LoginPageFactory::class,
            LogoutAction::class => LogoutFactory::class,
            TestePageAction::class => TestePageFactory::class,
            Cliente\ClienteListPageAction::class => Cliente\Factory\ClienteListPageFactory::class,
            Cliente\ClienteCreatePageAction::class => Cliente\Factory\ClienteCreatePageFactory::class,
            Cliente\ClienteUpdatePageAction::class => Cliente\Factory\ClienteUpdatePageFactory::class,
            Cliente\ClienteDeletePageAction::class => Cliente\Factory\ClienteDeletePageFactory::class,
            Contato\ContatoListPageAction::class => Contato\Factory\ContatoListPageFactory::class,
            Contato\ContatoCreatePageAction::class => Contato\Factory\ContatoCreatePageFactory::class,
            Contato\ContatoUpdatePageAction::class => Contato\Factory\ContatoUpdatePageFactory::class,
            Contato\ContatoDeletePageAction::class => Contato\Factory\ContatoDeletePageFactory::class,
            Tag\TagListPageAction::class => Tag\Factory\TagListPageFactory::class,
            Tag\TagCreatePageAction::class => Tag\Factory\TagCreatePageFactory::class,
            Tag\TagUpdatePageAction::class => Tag\Factory\TagUpdatePageFactory::class,
            Tag\TagDeletePageAction::class => Tag\Factory\TagDeletePageFactory::class,
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
            'name' => 'auth.login',
            'path' => '/auth/login',
            'middleware' => LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'auth.logout',
            'path' => '/auth/logout',
            'middleware' => LogoutAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'cliente.list',
            'path' => '/admin/clientes',
            'middleware' => Cliente\ClienteListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'cliente.create',
            'path' => '/admin/cliente/create',
            'middleware' => Cliente\ClienteCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'cliente.update',
            'path' => '/admin/cliente/update/{id}',
            'middleware' => Cliente\ClienteUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
        [
            'name' => 'cliente.delete',
            'path' => '/admin/cliente/{id}/delete',
            'middleware' => Cliente\ClienteDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
        [
            'name' => 'contato.list',
            'path' => '/admin/contatos',
            'middleware' => Contato\ContatoListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'contato.create',
            'path' => '/admin/contato/create',
            'middleware' => Contato\ContatoCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'contato.update',
            'path' => '/admin/contato/update/{id}',
            'middleware' => Contato\ContatoUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
        [
            'name' => 'contato.delete',
            'path' => '/admin/contato/{id}/delete',
            'middleware' => Contato\ContatoDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
        [
            'name' => 'tag.list',
            'path' => '/admin/tags',
            'middleware' => Tag\TagListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'tag.create',
            'path' => '/admin/tag/create',
            'middleware' => Tag\TagCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],
        [
            'name' => 'tag.update',
            'path' => '/admin/tag/update/{id}',
            'middleware' => Tag\TagUpdatePageAction::class,
            'allowed_methods' => ['GET','PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
        [
            'name' => 'tag.delete',
            'path' => '/admin/tag/{id}/delete',
            'middleware' => Tag\TagDeletePageAction::class,
            'allowed_methods' => ['GET','DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ],
        ],
    ],
];
