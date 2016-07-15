<?php

use Aura\Session\Session;
use DaMess\Factory\AuraSessionFactory;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\ClienteRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\ContatoRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\EnderecoRepositoryFactory;
use EmailMarketing\Infrastructure\Service\FlashMessageFactory;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            ClienteRepositoryInterface::class => ClienteRepositoryFactory::class,
            EnderecoRepositoryInterface::class => EnderecoRepositoryFactory::class,
            ContatoRepositoryInterface::class => ContatoRepositoryFactory::class,
            Session::class => AuraSessionFactory::class,
            FlashMessageInterface::class => FlashMessageFactory::class,
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Config
        ],
    ],
    
];
