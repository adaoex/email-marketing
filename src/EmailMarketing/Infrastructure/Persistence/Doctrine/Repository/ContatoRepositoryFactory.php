<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\Contato;
use Interop\Container\ContainerInterface;

class ContatoRepositoryFactory
{

    public function __invoke(ContainerInterface $container) : ContatoRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Contato::class);
    }

}
