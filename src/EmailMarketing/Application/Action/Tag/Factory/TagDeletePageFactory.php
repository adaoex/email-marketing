<?php

namespace EmailMarketing\Application\Action\Tag\Factory;

use EmailMarketing\Application\Action\Tag\TagDeletePageAction;
use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagDeletePageFactory
{

    public function __invoke(ContainerInterface $container): TagDeletePageAction
    {
        return new TagDeletePageAction(
                $container->get(TagRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(TagForm::class)
        );
    }

}
