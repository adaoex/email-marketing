<?php

namespace EmailMarketing\Application\Action\Tag;

use EmailMarketing\Application\Form\TagForm;
use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use EmailMarketing\Domain\Service\TagServiceInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class TagCreatePageAction
{

    private $template;
    
    private $repository;
    
    private $tagService;

    private $router;
    
    private $form;
    
    public function __construct(
        TagRepositoryInterface $repository,
        TagServiceInterface $tagService,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        TagForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->tagService = $tagService;
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
                    $this->tagService->create($entity);
                    $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Tag cadastrado com sucesso");
                    $uri = $this->router->generateUri('tag.list');
                    return new RedirectResponse( $uri );
                } catch (Exception $ex) {
                    $flash->setMessage(FlashMessageInterface::MESSAGE_ERROR, "Erro no cadastrado da tag");
                }    
            }
        }

        return new HtmlResponse(
            $this->template->render('app::tag/create', [
                'form' => $this->form
            ])
        );
    }
}
