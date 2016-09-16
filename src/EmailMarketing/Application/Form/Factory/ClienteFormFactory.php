<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Application\Form\ClienteForm;
use Interop\Container\ContainerInterface;

class ClienteFormFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ClienteForm(
                $container->get(EntityManager::class)
        );
    }

}
