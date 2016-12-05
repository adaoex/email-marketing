<?php

namespace EmailMarketing\Application\Action\Tag\Factory;

use EmailMarketing\Application\Action\Cliente\ClienteUpdatePageAction;
use EmailMarketing\Application\Action\Tag\TagUpdatePageAction;
use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagUpdatePageFactory
{

    public function __invoke(ContainerInterface $container): TagUpdatePageAction
    {
        return new TagUpdatePageAction(
                $container->get(TagRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(TagForm::class)
        );
    }

}
