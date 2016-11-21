<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Application\Form\ContatoForm;
use Interop\Container\ContainerInterface;

class ContatoFormFactory
{

    public function __invoke(ContainerInterface $container) : ContatoForm
    {
        return new ContatoForm(
                $container->get(EntityManager::class)
        );
    }

}
