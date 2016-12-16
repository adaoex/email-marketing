<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;

class ClienteRepository extends AbstractRepository implements ClienteRepositoryInterface
{

    public function findByEmail($email)
    {
        return $this->findBy(['email' => $email]);
    }

}
