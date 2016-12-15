<?php

namespace EmailMarketing\Application\Action\Campanha;

use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaReportInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CampanhaReportAction
{

    /**
     * @var CampanhaReportInterface
     */
    private $campanha;

    /**
     * @var CampanhaRepositoryInterface
     */
    private $repository;

    public function __construct(
        CampanhaRepositoryInterface $repository,
        CampanhaReportInterface $campanha
    ){
        $this->repository = $repository;
        $this->campanha = $campanha;
    }

    
    
    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ){
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
               
        $this->campanha->setCampanha($entity);
        
        return $this->campanha->render();
    }
}
