<?php

namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaReportFactory
{

    public function __invoke(ContainerInterface $container) : CampanhaReport
    {
        $templateRender = $container->get(TemplateRendererInterface::class);
        $mailgun =  $container->get(Mailgun::class);
        $mailgunConfig = $container->get('config')['mailgun'];
        $repository = $container->get(ContatoRepositoryInterface::class);
        return new CampanhaReport($templateRender, $mailgun, $mailgunConfig, $repository);
    }

}
