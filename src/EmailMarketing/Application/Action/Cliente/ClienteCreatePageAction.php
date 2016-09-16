<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Application\Form\ClienteForm;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Service\ClienteServiceInterface;
use Exception;
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
    
    private $clienteService;

    private $router;
    
    private $form;
    
    public function __construct(
            ClienteRepositoryInterface $repository,
            ClienteServiceInterface $clienteService,
            Template\TemplateRendererInterface $template,
            RouterInterface $router,
            ClienteForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->clienteService = $clienteService;
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
                
                try {
                    $this->clienteService->create($entity);
                    $flash->setMessage("success", "Cliente cadastrado com sucesso");
                    $uri = $this->router->generateUri('cliente.list');
                    return new RedirectResponse( $uri );
                } catch (Exception $ex) {
                    $flash->setMessage("error", "Erro no cadastrado do cliente");
                }    
            }
        }

        return new HtmlResponse(
            $this->template->render('app::cliente/create', [
                'form' => $this->form
            ])
        );
    }
}
