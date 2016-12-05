<?php

namespace EmailMarketing\Application\Action\Tag;

use EmailMarketing\Application\Form\HttpMethodElement;
use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SebastianBergmann\RecursionContext\Exception;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class TagUpdatePageAction
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
                    $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Tag cadastrado com sucesso");
                    $uri = $this->router->generateUri('tag.list');
                    return new RedirectResponse( $uri );
                } catch (Exception $ex) {
                    $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro no cadastrado do tag");
                }    
            }
        }

        return new HtmlResponse(
            $this->template->render('app::tag/update', [
                'tag' => $entity,
                'form' => $this->form,
            ])
        );
    }
}
