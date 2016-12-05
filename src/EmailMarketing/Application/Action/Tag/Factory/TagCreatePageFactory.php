<?php

namespace EmailMarketing\Application\Action\Tag\Factory;

use EmailMarketing\Application\Action\Tag\TagCreatePageAction;
use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\TagServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagCreatePageFactory
{

    public function __invoke(ContainerInterface $container): TagCreatePageAction
    {
        return new TagCreatePageAction(
                $container->get(TagRepositoryInterface::class),
                $container->get(TagServiceInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(TagForm::class)
        );
    }

}
