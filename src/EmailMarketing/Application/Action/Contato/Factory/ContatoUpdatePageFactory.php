<?php

namespace EmailMarketing\Application\Action\Contato\Factory;

use EmailMarketing\Application\Action\Contato\ContatoUpdatePageAction;
use EmailMarketing\Application\Form\ContatoForm;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ContatoUpdatePageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ContatoUpdatePageAction(
                $container->get(ContatoRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(ContatoForm::class)
        );
    }

}
