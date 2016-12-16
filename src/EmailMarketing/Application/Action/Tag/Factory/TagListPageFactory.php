<?php

namespace EmailMarketing\Application\Action\Tag\Factory;

use EmailMarketing\Application\Action\Tag\TagListPageAction;
use EmailMarketing\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagListPageFactory
{

    public function __invoke(ContainerInterface $container) : TagListPageAction
    {
        $findByNomeCriteria = $container->get(FindByNameCriteriaInterface::class);
        return new TagListPageAction(
                $container->get(TagRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $findByNomeCriteria
        );
    }

}
