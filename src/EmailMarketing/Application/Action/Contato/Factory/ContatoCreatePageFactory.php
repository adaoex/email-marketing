<?php

namespace EmailMarketing\Application\Action\Contato\Factory;

use EmailMarketing\Application\Action\Contato\ContatoCreatePageAction;
use EmailMarketing\Application\Form\ContatoForm;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ContatoCreatePageFactory
{

    public function __invoke(ContainerInterface $container): ContatoCreatePageAction
    {
        return new ContatoCreatePageAction(
                $container->get(ContatoRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(ContatoForm::class)
        );
    }

}
