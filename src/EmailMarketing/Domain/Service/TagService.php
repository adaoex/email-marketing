<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Tag;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\TagServiceInterface;

class TagService implements TagServiceInterface
{

    /**
     * @var TagServiceInterface 
     */
    private $tagRepository;
    
    public function __construct(
        TagRepositoryInterface $tagRepository
    ){
        $this->tagRepository = $tagRepository;
    }

    public function create(Tag $entity)
    {
        $this->tagRepository->create($entity);
    }

    public function update(Tag $entity)
    {
        $this->tagRepository->update($entity);
    }

    public function remove(Tag $entity)
    {
        $this->tagRepository->remove($entity);
    }

}
