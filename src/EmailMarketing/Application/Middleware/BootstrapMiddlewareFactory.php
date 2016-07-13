<?php

namespace EmailMarketing\Application\Middleware;

use EmailMarketing\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();
        return new BootstrapMiddleware($bootstrap);
    }
}
