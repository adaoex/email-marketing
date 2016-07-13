<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;

class ClienteRepository extends EntityRepository implements ClienteRepositoryInterface
{

    public function create($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function findByEmail($email)
    {
        
    }

    public function remove($entity)
    {
        
    }

    public function update($entity)
    {
        
    }

}
