<?php

namespace EmailMarketing\Application\Action\Cliente\Factory;

use EmailMarketing\Application\Action\Cliente\ClienteUpdatePageAction;
use EmailMarketing\Application\Form\ClienteForm;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ClienteUpdatePageFactory
{

    public function __invoke(ContainerInterface $container): ClienteUpdatePageAction
    {
        return new ClienteUpdatePageAction(
                $container->get(ClienteRepositoryInterface::class),
                $container->get(EnderecoRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(ClienteForm::class)
        );
    }

}
