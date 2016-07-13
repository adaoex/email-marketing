<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\Cliente;
use Interop\Container\ContainerInterface;

class ClienteRepositoryFactory
{

    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Cliente::class);
    }

}
