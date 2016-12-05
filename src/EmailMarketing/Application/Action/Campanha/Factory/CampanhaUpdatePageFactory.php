<?php

namespace EmailMarketing\Application\Action\Campanha\Factory;

use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaUpdatePageFactory
{

    public function __invoke(ContainerInterface $container): CampanhaUpdatePageAction
    {
        return new CampanhaUpdatePageAction(
                $container->get(CampanhaRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get(RouterInterface::class),
                $container->get(CampanhaForm::class)
        );
    }

}
