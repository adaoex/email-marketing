<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Interop\Container\ContainerInterface;

class ClienteServiceFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $clienteReposotory = $container->get(ClienteRepositoryInterface::class);
        return new ClienteService($clienteReposotory);
    }

}
