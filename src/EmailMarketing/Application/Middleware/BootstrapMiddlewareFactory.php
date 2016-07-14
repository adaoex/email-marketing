<?php

namespace EmailMarketing\Application\Middleware;

use EmailMarketing\Domain\Service\FlashMessageInterface;
use EmailMarketing\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapMiddlewareFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();
        $flash = $container->get(FlashMessageInterface::class);
        return new BootstrapMiddleware($bootstrap, $flash);
    }

}
