<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ClienteDeletePageAction
{

    private $template;
    
    private $repository;

    private $router;
     
    public function __construct(
    ClienteRepositoryInterface $repository,
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
        $entity = $this->repository->find($id);
                
        if ( $request->getMethod() == "DELETE" ){
            try {
                $this->repository->remove($entity);
                $flash->setMessage('success', "Cliente excluído com sucesso");
            } catch (\Exception $exc) {
                $flash->setMessage('error', "Erro ao excluir contato");
            }
            $uri = $this->router->generateUri('cliente.list');
            return new RedirectResponse( $uri );
        }
        
        return new HtmlResponse(
            $this->template->render('app::cliente/delete', [
                'cliente' => $entity,
            ])
        );
    }
}
