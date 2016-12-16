<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\Repository;

use EmailMarketing\Domain\Persistence\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface
{
    use QueryBuilderTrait;
    use RepositoryCriteriaTrait;
}
