<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Entity\Contato;

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

}
