<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Domain\Entity\Cliente;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ClienteCreatePageAction
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
       
        if ( $request->getMethod() == "POST" ){
            $data = $request->getParsedBody();
            $entity = new Cliente();
            $entity->setNome($data['nome'])
                    ->setCpf($data['cpf'])
                    ->setEmail($data['email']);
            $this->repository->create($entity);
           
            $flash->setMessage('success', "Cliente cadastrado com sucesso");
            $uri = $this->router->generateUri('cliente.list');
            return new RedirectResponse( $uri );
        }

        return new HtmlResponse(
            $this->template->render('app::cliente/create')
        );
    }
}
