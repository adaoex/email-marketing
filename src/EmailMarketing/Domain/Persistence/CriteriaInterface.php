<?php

/*
 * Implementação dos conceitos de comínio de critério 
 * http://martinfowler.com/eaaCatalog/repository.html
 */

namespace EmailMarketing\Domain\Persistence;

/**
 *
 * @author Adão Gonçalves <adao@adao.eti.br>
 */
interface CriteriaInterface
{
    public function apply(RepositoryCriteriaInterface $repository); 
}
