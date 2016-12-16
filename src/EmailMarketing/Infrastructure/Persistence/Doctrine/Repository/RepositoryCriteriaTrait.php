<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use EmailMarketing\Domain\Persistence\CriteriaInterface;

trait RepositoryCriteriaTrait{
    
    protected $criterias = [];
    public $ALIAS_ENTITY = 'a';

    public function add(CriteriaInterface $criteria)
    {
        $this->criterias[] = $criteria;
    }

    public function set(array $criterias)
    {
        $this->criterias = $criterias;
    }

    public function findWithCriteria()
    {
        $this->queryBuilder = $this->createQueryBuilder( $this->ALIAS_ENTITY );
        foreach ($this->criterias as $criteria) {
            $criteria->apply($this);
        }
        return $this->queryBuilder->getQuery()->getResult();
    }
    
}