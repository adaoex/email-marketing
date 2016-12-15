<?php

namespace EmailMarketing\Domain\Persistence;

interface ContatoRepositoryInterface extends RepositoryInterface
{

    public function findByEmail($email);
    
    public function findByTags(array $tags): array;
    
}
