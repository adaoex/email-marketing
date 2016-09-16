<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Application\Form\ClienteForm;
use EmailMarketing\Application\Form\HttpMethodElement;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Persistence\EnderecoRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ClienteUpdatePageAction
{

    private $template;
    
    private $repository;
    
    private $repositoryEndereco;

    private $router;
     
    private $form;
    
    public function __construct(
            ClienteRepositoryInterface $repository,
            EnderecoRepositoryInterface $repositoryEndereco,
            Template\TemplateRendererInterface $template,
            RouterInterface $router,
            ClienteForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->repositoryEndereco = $repositoryEndereco;
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
            $flash = $request->getAttribute('flash');
            $dataForm = $request->getParsedBody();
            
            $this->form->setData($dataForm);
            
            if ( $this->form->isValid() ){
                $entity = $this->form->getData();
                
                try {
                    $this->repository->update($entity);
                    $flash->setMessage("success", "Cliente cadastrado com sucesso");
                    $uri = $this->router->generateUri('cliente.list');
                    return new RedirectResponse( $uri );
                } catch (Exception $ex) {
                    $flash->setMessage("error", "Erro no cadastrado do cliente");
                }    
            }
        }

        return new HtmlResponse(
            $this->template->render('app::cliente/update', [
                'cliente' => $entity,
                'form' => $this->form,
            ])
        );
    }
}
