<?php

namespace EmailMarketing\Application\Action\Campanha\Factory;

use EmailMarketing\Application\Action\Campanha\CampanhaSenderPageAction;
use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaEmailSenderInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaSenderPageFactory
{

    public function __invoke(ContainerInterface $container): CampanhaSenderPageAction
    {
        return new CampanhaSenderPageAction(
                $container->get(CampanhaRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(CampanhaForm::class),
                $container->get(CampanhaEmailSenderInterface::class)
        );
    }

}
