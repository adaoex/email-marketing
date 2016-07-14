<?php

namespace EmailMarketing\Application\Action\Cliente\Factory;

use EmailMarketing\Application\Action\Cliente\ClienteListPageAction;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ClienteListPageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ClienteListPageAction(
                $container->get(ClienteRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class)
        );
    }

}
