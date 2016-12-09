<?php

namespace EmailMarketing\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;

class MailgunFactory
{

    public function __invoke(ContainerInterface $container) : Mailgun
    {
        $apiKey = $container->get('config')['mailgun']['key'];
        return new Mailgun($apiKey);
    }

}
