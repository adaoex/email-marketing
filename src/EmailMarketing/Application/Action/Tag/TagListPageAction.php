<?php

namespace EmailMarketing\Application\Action\Tag;

use EmailMarketing\Domain\Persistence\TagRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TagListPageAction
{

    private $template;
    
    private $repository;

    public function __construct(
        TagRepositoryInterface $repository,
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

        $tags = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        $message = $flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS);
        return new HtmlResponse(
            $this->template->render('app::tag/list', [
                'tags' => $tags,
                'message' => $message,
            ]
        ));
    }
}
