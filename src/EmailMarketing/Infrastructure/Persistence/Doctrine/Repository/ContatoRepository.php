<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use EmailMarketing\Domain\Entity\Tag;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;

class ContatoRepository extends AbstractRepository implements ContatoRepositoryInterface
{

    public function findByEmail($email): array
    {
        return $this->findBy(['email' => $email]);
    }

    public function findByTags(array $tags): array
    {
        $queryBuilder = $this->createQueryBuilder('c')
                ->distinct()
                ->leftJoin(Tag::class, 't')
                ->andWhere('t.id IN (:tag_ids)')
                ->setParameter('tag_ids', $tags );
        return $queryBuilder->getQuery()->getResult();
    }

}
