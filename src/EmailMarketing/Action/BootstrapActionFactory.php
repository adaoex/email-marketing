<?php

namespace EmailMarketing\Action;

use EmailMarketing\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();
        return new BootstrapAction($bootstrap);
    }
}
