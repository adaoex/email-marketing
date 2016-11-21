<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use EmailMarketing\Domain\Entity\Endereco;

class EnderecoRepository extends EntityRepository implements EnderecoRepositoryInterface
{

    public function create($entity): Endereco
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }

    public function remove($entity)
    {
        
    }

    public function update($entity): Endereco
    {
        
    }

}
