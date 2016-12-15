<?php

namespace EmailMarketing\Application\Action\Campanha\Factory;

use EmailMarketing\Application\Action\Campanha\CampanhaReportAction;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaReportInterface;
use Interop\Container\ContainerInterface;

class CampanhaReportFactory
{

    public function __invoke(ContainerInterface $container): CampanhaReportAction
    {   
        return new CampanhaReportAction(
                $container->get(CampanhaRepositoryInterface::class),
                $container->get(CampanhaReportInterface::class)
        );
    }

}
