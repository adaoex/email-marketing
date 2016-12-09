<?php

namespace EmailMarketing\Application\Action\Campanha\Factory;

use EmailMarketing\Application\Action\Campanha\CampanhaListPageAction;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaListPageFactory
{

    public function __invoke(ContainerInterface $container): CampanhaListPageAction
    {
        
        return new CampanhaListPageAction(
                $container->get(CampanhaRepositoryInterface::class),
                $container->get(TemplateRendererInterface::class),
                $container->get( Mailgun::class )
        );
    }

}
