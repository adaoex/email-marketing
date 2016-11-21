<?php

namespace EmailMarketing\Domain\Persistence;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function findByEmail($email);
    
}
