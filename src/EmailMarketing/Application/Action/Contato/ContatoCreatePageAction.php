<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Application\Form\ContatoForm;
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
    
    private $form;
     
    public function __construct(
            ContatoRepositoryInterface $repository,
            Template\TemplateRendererInterface $template,
            RouterInterface $router,
            ContatoForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ) {
        
        if ( $request->getMethod() == "POST" ){
            $flash = $request->getAttribute('flash');
            $dataForm = $request->getParsedBody();
            
            $this->form->setData($dataForm);
            
            if ( $this->form->isValid() ){
                $entity = $this->form->getData();
                $this->repository->create($entity);
                $flash->setMessage("success", "Contato cadastrado com sucesso");
                $uri = $this->router->generateUri('contato.list');
                return new RedirectResponse( $uri );
            }else{
                $flash->setMessage("error", "Erro no cadastrado do cliente");
            }
        }

        return new HtmlResponse(
            $this->template->render('app::contato/create', [
                'form' => $this->form,
            ])
        );
    }
}
