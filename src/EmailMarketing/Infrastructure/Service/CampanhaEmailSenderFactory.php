<?php

namespace EmailMarketing\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampanhaEmailSenderFactory
{

    public function __invoke(ContainerInterface $container) : CampanhaEmailSender
    {
        $templateRender = $container->get(TemplateRendererInterface::class);
        $mailgun =  $container->get(Mailgun::class);
        $mailgunConfig = $container->get('config')['mailgun'];
        return new CampanhaEmailSender($templateRender, $mailgun, $mailgunConfig);
    }

}
