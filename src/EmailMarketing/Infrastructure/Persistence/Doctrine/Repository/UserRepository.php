<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMarketing\Domain\Persistence\UserRepositoryInterface;
use EmailMarketing\Domain\Entity\User;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{

    public function create($entity): User
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function update($entity): User
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
