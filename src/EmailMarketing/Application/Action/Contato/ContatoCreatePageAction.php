<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Domain\Entity\Contato;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ContatoCreatePageAction
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
        
        if ( $request->getMethod() == "POST" ){
            $flash = $request->getAttribute('flash');
            $data = $request->getParsedBody();
            $entity = new Contato();
            $entity->setNome($data['nome'])
                    ->setEmail($data['email']);
            $this->repository->create($entity);
           
            $flash->setMessage("success", "Contato cadastrado com sucesso");
            $uri = $this->router->generateUri('contato.list');
            return new RedirectResponse( $uri );
        }

        return new HtmlResponse(
            $this->template->render('app::contato/create')
        );
    }
}
