<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;

class TagServiceFactory
{

    public function __invoke(ContainerInterface $container) : TagService
    {
        $repository = $container->get( TagRepositoryInterface::class);
        return new TagService($repository);
    }

}
