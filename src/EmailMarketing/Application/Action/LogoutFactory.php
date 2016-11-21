<?php

namespace EmailMarketing\Application\Action;

use EmailMarketing\Domain\Service\AuthInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class LogoutFactory
{
    public function __invoke(ContainerInterface $container): LogoutAction
    {
        $router   = $container->get(RouterInterface::class);
        $authService = $container->get(AuthInterface::class);
        return new LogoutAction($router, $authService);
    }
}
