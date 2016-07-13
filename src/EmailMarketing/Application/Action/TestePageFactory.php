<?php

namespace EmailMarketing\Application\Action;

use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestePageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class)) 
                ? $container->get(TemplateRendererInterface::class) 
                : null;

        return new TestePageAction(
                $container->get(ClienteRepositoryInterface::class), $template
        );
    }

}
