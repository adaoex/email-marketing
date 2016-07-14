<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class ClienteListPageAction
{

    private $template;
    
    private $repository;

    public function __construct(
            ClienteRepositoryInterface $repository,
            Template\TemplateRendererInterface $template = null
    ){
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ){

        $clientes = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        $message = $flash->getMessage('success');
        return new HtmlResponse(
            $this->template->render('app::cliente/list', [
                'clientes' => $clientes,
                'message' => $message,
            ]
        ));
    }
}
