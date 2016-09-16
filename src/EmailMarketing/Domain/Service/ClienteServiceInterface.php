<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Cliente;

interface ClienteServiceInterface
{

    public function create(Cliente $entity);

    public function update(Cliente $entity);

    public function remove(Cliente $entity);
    
}
