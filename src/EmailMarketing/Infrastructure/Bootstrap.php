<?php

namespace EmailMarketing\Infrastructure;

use EmailMarketing\Domain\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function create()
    {
        require __DIR__ . '/config/doctrine.php';
    }

}