<?php
declare(strict_type=1);
namespace EmailMarketing\Domain\Persistence\Criteria;

use EmailMarketing\Domain\Persistence\CriteriaInterface;

interface FindByNameCriteriaInterface extends CriteriaInterface
{
    public function setNome($nome); 
    public function getNome(); 
}