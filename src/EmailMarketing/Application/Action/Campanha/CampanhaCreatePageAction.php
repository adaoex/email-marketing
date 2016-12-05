<?php

namespace EmailMarketing\Application\Action\Campanha;

use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class CampanhaCreatePageAction
{

    private $template;
    
    private $repository;

    private $router;
    
    private $form;
     
    public function __construct(
        CampanhaRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampanhaForm $form
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
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Campanha cadastrado com sucesso");
                $uri = $this->router->generateUri('campanha.list');
                return new RedirectResponse( $uri );
            }else{
                $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro no cadastrado do Campanha");
            }
        }

        return new HtmlResponse(
            $this->template->render('app::campanha/create', [
                'form' => $this->form,
            ])
        );
    }
}
