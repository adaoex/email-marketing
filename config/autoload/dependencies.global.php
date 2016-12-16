<?php

use CodeEdu\FixtureFactory;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\AuthInterface;
use EmailMarketing\Domain\Service\CampanhaEmailSenderInterface;
use EmailMarketing\Domain\Service\CampanhaReportInterface;
use EmailMarketing\Domain\Service\ClienteServiceFactory;
use EmailMarketing\Domain\Service\ClienteServiceInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use EmailMarketing\Domain\Service\TagServiceFactory;
use EmailMarketing\Domain\Service\TagServiceInterface;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\CampanhaRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\ClienteRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\ContatoRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\Criteria\FindByNameCriteria;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\EnderecoRepositoryFactory;
use EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\TagRepositoryFactory;
use EmailMarketing\Infrastructure\Service\AuthServiceFactory;
use EmailMarketing\Infrastructure\Service\CampanhaEmailSenderFactory;
use EmailMarketing\Infrastructure\Service\CampanhaReportFactory;
use EmailMarketing\Infrastructure\Service\FlashMessageFactory;
use EmailMarketing\Infrastructure\Service\MailgunFactory;
use Mailgun\Mailgun;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Helper\UrlHelperFactory;


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
            ServerUrlHelper::class => ServerUrlHelper::class,
            FindByNameCriteriaInterface::class => FindByNameCriteria::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            UrlHelper::class => UrlHelperFactory::class,
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
            Mailgun::class => MailgunFactory::class,
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
