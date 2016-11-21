<?php

namespace EmailMarketing\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;

class AuthServiceFactory
{

    public function __invoke(ContainerInterface $container) : AuthService
    {
        $authenticationService = $container->get( AuthenticationServiceInterface::class );
        return new AuthService( $authenticationService );
    }

}
