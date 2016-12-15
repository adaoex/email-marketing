<?php

use CodeEdu\FixtureFactory;
use EmailMarketing\Domain\{
    Persistence\ClienteRepositoryInterface,
    Persistence\ContatoRepositoryInterface,
    Persistence\EnderecoRepositoryInterface,
    Persistence\TagRepositoryInterface,
    Persistence\CampanhaRepositoryInterface,
    Service\AuthInterface,
    Service\ClienteServiceFactory,
    Service\ClienteServiceInterface,
    Service\TagServiceInterface,
    Service\TagServiceFactory,
    Service\FlashMessageInterface,
    Service\CampanhaEmailSenderInterface,
    Service\CampanhaReportInterface
};
use EmailMarketing\Infrastructure\{
    Persistence\Doctrine\Repository\ClienteRepositoryFactory,
    Persistence\Doctrine\Repository\ContatoRepositoryFactory,
    Persistence\Doctrine\Repository\EnderecoRepositoryFactory,  
    Persistence\Doctrine\Repository\TagRepositoryFactory,  
    Persistence\Doctrine\Repository\CampanhaRepositoryFactory,  
    Service\AuthServiceFactory,
    Service\FlashMessageFactory,
    Service\MailgunFactory,
    Service\CampanhaEmailSenderFactory,
    Service\CampanhaReportFactory
};
use Zend\{
    Authentication\AuthenticationService,
    Authentication\AuthenticationServiceInterface,
    Expressive\Application,
    Expressive\Container\ApplicationFactory,
    Expressive\Helper
};


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
            ClienteServiceInterface::class => ClienteServiceFactory::class,
            EnderecoRepositoryInterface::class => EnderecoRepositoryFactory::class,
            ContatoRepositoryInterface::class => ContatoRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            TagServiceInterface::class => TagServiceFactory::class,
            CampanhaRepositoryInterface::class => CampanhaRepositoryFactory::class,
            FlashMessageInterface::class => FlashMessageFactory::class,
            'doctrine:fixtures_cmd:load'   => FixtureFactory::class,
            AuthInterface::class => AuthServiceFactory::class,
            \Mailgun\Mailgun::class => MailgunFactory::class,
            CampanhaEmailSenderInterface::class => CampanhaEmailSenderFactory::class,
            CampanhaReportInterface::class => CampanhaReportFactory::class,
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Config
            AuthenticationServiceInterface::class => 'doctrine.authenticationservice.orm_default',
            AuthenticationService::class  => 'doctrine.authenticationservice.orm_default',
        ],
    ],
    
];
