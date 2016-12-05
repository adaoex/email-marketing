<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Application\Form\TagForm;
use Interop\Container\ContainerInterface;

class TagFormFactory
{

    public function __invoke(ContainerInterface $container) : TagForm
    {
        return new TagForm(
                $container->get(EntityManager::class)
        );
    }

}
