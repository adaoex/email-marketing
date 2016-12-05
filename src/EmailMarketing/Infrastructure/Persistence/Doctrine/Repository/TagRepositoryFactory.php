<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\Tag;
use Interop\Container\ContainerInterface;

class TagRepositoryFactory
{

    public function __invoke(ContainerInterface $container) : TagRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Tag::class);
    }

}
