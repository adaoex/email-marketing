<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository\Criteria;

use Doctrine\ORM\QueryBuilder;
use EmailMarketing\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use EmailMarketing\Domain\Persistence\RepositoryCriteriaInterface;

class FindByNameCriteria implements FindByNameCriteriaInterface
{
    private $nome;
    
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function apply(RepositoryCriteriaInterface $repository)
    {
        $alias = $repository->ALIAS_ENTITY;
        /** @var QueryBuilder */
        $queryBuilder = $repository->getQueryBuilder();
        $queryBuilder->andWhere("$alias.nome = :nome")
                ->setParameter('nome', $this->getNome());
    }

}