<?php

namespace EmailMarketing\Infrastructure;

use EmailMarketing\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function create()
    {
        require __DIR__ . '/config/doctrine.php';
    }

}