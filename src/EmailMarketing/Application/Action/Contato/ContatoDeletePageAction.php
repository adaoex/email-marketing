<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ContatoDeletePageAction
{

    private $template;
    
    private $repository;

    private $router;
     
    public function __construct(
            ContatoRepositoryInterface $repository,
            Template\TemplateRendererInterface $template,
            RouterInterface $router
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ) {
        $flash = $request->getAttribute('flash');
        $id = $request->getAttribute('id');
        
        try {
            $entity = $this->repository->find($id);
            $this->repository->remove($entity);
            $flash->setMessage('success', "Contato excluído com sucesso");
        } catch (\Exception $exc) {
            $flash->setMessage('error', "Erro ao excluir contato");
        }
        
        $uri = $this->router->generateUri('contato.list');
        return new RedirectResponse( $uri );

    }
}
