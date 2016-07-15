<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ContatoUpdatePageAction
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
        $entity = $this->repository->find($id);
        
        if ( $request->getMethod() == "PUT" ){
            $data = $request->getParsedBody();
            
            $entity->setNome($data['nome'])
                    ->setEmail($data['email']);
            $this->repository->update($entity);
           
            $flash->setMessage('success', "Contato editado com sucesso");
            $uri = $this->router->generateUri('contato.list');
            return new RedirectResponse( $uri );
        }

        return new HtmlResponse(
            $this->template->render('app::contato/update', [
                'contato' => $entity,
            ])
        );
    }
}
