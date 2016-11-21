<?php

namespace EmailMarketing\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $flashMassenger = new FlashMessenger();
        return new FlashMessage($flashMassenger);
    }

}
