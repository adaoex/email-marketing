<?php

namespace EmailMarketing\Application\Action\Contato\Factory;

use EmailMarketing\Application\Action\Contato\ContatoListPageAction;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ContatoListPageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ContatoListPageAction(
                $container->get(ContatoRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class)
        );
    }

}
