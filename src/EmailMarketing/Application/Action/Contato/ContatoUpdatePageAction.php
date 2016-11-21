<?php

namespace EmailMarketing\Application\Action\Contato;

use EmailMarketing\Application\Form\ContatoForm;
use EmailMarketing\Application\Form\HttpMethodElement;
use EmailMarketing\Domain\Persistence\ContatoRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
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
        
        $flash = $request->getAttribute('flash');
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        
        $this->form->add(new HttpMethodElement('PUT'));
        $this->form->bind($entity);
        
        if ( $request->getMethod() == "PUT" ){
            $dataForm = $request->getParsedBody();
            $this->form->setData($dataForm);
            
            if ( $this->form->isValid() ){
                $entity = $this->form->getData();
                $this->repository->update($entity);
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Contato editado com sucesso");
                $uri = $this->router->generateUri('contato.list');
                return new RedirectResponse( $uri );
            }else{
                $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro no cadastrado do contato");
            }
        }

        return new HtmlResponse(
            $this->template->render('app::contato/update', [
                'form' => $this->form,
            ])
        );
    }
}
