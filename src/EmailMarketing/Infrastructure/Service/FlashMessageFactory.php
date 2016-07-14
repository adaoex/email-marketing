<?php

namespace EmailMarketing\Infrastructure\Service;

use Aura\Session\Session;
use Interop\Container\ContainerInterface;

class FlashMessageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new FlashMessage($container->get(Session::class));
    }

}
