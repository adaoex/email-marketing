<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use EmailMarketing\Domain\Persistence\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    public function findByEmail($email): array
    {
        return $this->findBy(['email' => $email]);
    }

}
