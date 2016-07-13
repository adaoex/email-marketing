<?php

namespace EmailMarketing\Domain\Persistence;

interface ClienteRepositoryInterface extends RepositoryInterface
{

    public function findByEmail($email);
    
}
