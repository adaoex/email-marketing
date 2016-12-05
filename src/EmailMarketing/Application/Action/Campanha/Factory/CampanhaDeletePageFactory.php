<?php

namespace EmailMarketing\Application\Action\Campanha\Factory;

use EmailMarketing\Application\Action\Campanha\CampanhaDeletePageAction;
use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaDeletePageFactory
{

    public function __invoke(ContainerInterface $container): CampanhaDeletePageAction
    {
        return new CampanhaDeletePageAction(
                $container->get(CampanhaRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(CampanhaForm::class)
        );
    }

}
