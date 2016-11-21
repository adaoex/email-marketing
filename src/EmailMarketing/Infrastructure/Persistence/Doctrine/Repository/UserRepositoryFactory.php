<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\User;
use Interop\Container\ContainerInterface;

class UserRepositoryFactory
{

    public function __invoke(ContainerInterface $container): UserRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(User::class);
    }

}
