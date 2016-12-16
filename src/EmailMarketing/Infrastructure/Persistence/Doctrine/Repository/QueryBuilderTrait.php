<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\QueryBuilder;

trait QueryBuilderTrait{
    
    /**
     * @var QueryBuilder 
     */
    protected $queryBuilder;
    
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }
    
}