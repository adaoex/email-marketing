<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class ContatoListPageAction
{

    private $template;
    
    private $repository;

    public function __construct(
    ContatoRepositoryInterface $repository,
            Template\TemplateRendererInterface $template
    ){
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ){

        $contatos = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        $message = $flash->getMessage('success');
        return new HtmlResponse(
            $this->template->render('app::contato/list', [
                'contatos' => $contatos,
                'message' => $message,
            ]
        ));
    }
}
