<?php
declare(strinct_types = 1);
namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Domain\Entity\Campanha;
use Interop\Container\ContainerInterface;

class CampanhaRepositoryFactory
{

    public function __invoke(ContainerInterface $container) : CampanhaRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Campanha::class);
    }

}
