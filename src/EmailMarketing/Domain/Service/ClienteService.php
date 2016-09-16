<?php

namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\Cliente;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;

class ClienteService implements ClienteServiceInterface
{

    /**
     * @var ClienteRepositoryInterface 
     */
    private $clienteRepository;
    
    public function __construct(
        ClienteRepositoryInterface $clienteRepository
    ){
        $this->clienteRepository = $clienteRepository;
    }

    public function create(Cliente $entity)
    {
        $this->clienteRepository->create($entity);
    }

    public function update(Cliente $entity)
    {
        $this->clienteRepository->update($entity);
    }

    public function remove(Cliente $entity)
    {
        $this->clienteRepository->remove($entity);
    }

}
