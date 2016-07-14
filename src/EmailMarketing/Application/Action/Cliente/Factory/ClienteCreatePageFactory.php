<?php

namespace EmailMarketing\Application\Action\Cliente\Factory;

use EmailMarketing\Application\Action\Cliente\ClienteCreatePageAction;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ClienteCreatePageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ClienteCreatePageAction(
                $container->get(ClienteRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class)
        );
    }

}
