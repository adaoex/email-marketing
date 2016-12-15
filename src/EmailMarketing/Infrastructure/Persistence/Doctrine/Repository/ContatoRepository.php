<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMarketing\Domain\Entity\Contato;
use EmailMarketing\Domain\Entity\Tag;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;

class ContatoRepository extends EntityRepository implements ContatoRepositoryInterface
{

    public function create($entity) : Contato
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function update($entity): Contato
    {
        if ( $this->getEntityManager()->getUnitOfWork()->getEntityState($entity) != UnitOfWork::STATE_MANAGED ){
            $this->getEntityManager()->merge($entity);
        }
        $this->getEntityManager()->flush();
        return $entity;
    }
    
    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
    
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
