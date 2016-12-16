<?php

/*
 * Implementação dos conceitos de comínio de critério 
 * http://martinfowler.com/eaaCatalog/repository.html
 */

namespace EmailMarketing\Domain\Persistence;

use Doctrine\ORM\QueryBuilder;

/**
 *
 * @author Adão Gonçalves <adao@adao.eti.br>
 */
interface RepositoryCriteriaInterface
{
    public function add(CriteriaInterface $criteria);
    public function set(array $criterias);
    public function findWithCriteria(); 
    
    public function setQueryBuilder(QueryBuilder $queryBuilder);
    public function getQueryBuilder();
}
