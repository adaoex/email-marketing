<?php

namespace EmailMarketing\Application\Action\Cliente;

use EmailMarketing\Application\Form\ClienteForm;
use EmailMarketing\Application\Form\HttpMethodElement;
use EmailMarketing\Domain\Persistence\ClienteRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class ClienteDeletePageAction
{

    private $template;
    
    private $repository;

    private $router;
     
    private $form;
    
    public function __construct(
        ClienteRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        ClienteForm $form
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

        $this->form->add(new HttpMethodElement('DELETE'));
        $this->form->bind($entity);
        
        if ( $request->getMethod() == "DELETE" ){
            try {
                $this->repository->remove($entity);
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Cliente excluído com sucesso");
            } catch (\Exception $exc) {
                $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro ao excluir contato");
            }
            $uri = $this->router->generateUri('cliente.list');
            return new RedirectResponse( $uri );
        }
        
        return new HtmlResponse(
            $this->template->render('app::cliente/delete', [
                'form' => $this->form,
            ])
        );
    }
}
