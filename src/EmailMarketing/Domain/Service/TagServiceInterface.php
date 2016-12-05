<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Tag;

interface TagServiceInterface
{

    public function create(Tag $entity);

    public function update(Tag $entity);

    public function remove(Tag $entity);
    
}
