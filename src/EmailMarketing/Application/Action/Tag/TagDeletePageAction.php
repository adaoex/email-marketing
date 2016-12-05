<?php

namespace EmailMarketing\Application\Action\Tag;

use EmailMarketing\Application\Form\HttpMethodElement;
use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class TagDeletePageAction
{

    private $template;
    
    private $repository;

    private $router;
     
    private $form;
    
    public function __construct(
        TagRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        TagForm $form
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
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Tag excluído com sucesso");
            } catch (Exception $exc) {
                $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro ao excluir tag");
            }
            $uri = $this->router->generateUri('tag.list');
            return new RedirectResponse( $uri );
        }
        
        return new HtmlResponse(
            $this->template->render('app::tag/delete', [
                'form' => $this->form,
            ])
        );
    }
}
