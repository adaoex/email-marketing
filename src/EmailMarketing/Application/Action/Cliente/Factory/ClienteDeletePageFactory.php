<?php

namespace EmailMarketing\Application\Action\Cliente\Factory;

use EmailMarketing\Application\Action\Cliente\ClienteDeletePageAction;
use EmailMarketing\Application\Form\ClienteForm;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ClienteDeletePageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        return new ClienteDeletePageAction(
                $container->get(ClienteRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(ClienteForm::class)
        );
    }

}
