<?php

namespace EmailMarketing\Application\Action\Contato\Factory;

use EmailMarketing\Application\Action\Contato\ContatoDeletePageAction;
use EmailMarketing\Application\Form\ContatoForm;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ContatoDeletePageFactory
{

    public function __invoke(ContainerInterface $container): ContatoDeletePageAction
    {
        return new ContatoDeletePageAction(
                $container->get(ContatoRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(ContatoForm::class)
        );
    }

}
