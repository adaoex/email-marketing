<?php

namespace EmailMarketing\Application\Action\Campanha;

use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Mailgun\Mailgun;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class CampanhaListPageAction
{

    private $template;
    
    private $repository;

    private $mailgun;
    
    public function __construct(
        CampanhaRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        Mailgun $mailgun
    ){
        $this->template = $template;
        $this->repository = $repository;
        $this->mailgun = $mailgun;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ){

        $campanhas = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        $message = $flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS);
        return new HtmlResponse(
            $this->template->render('app::campanha/list', [
                'campanhas' => $campanhas,
                'message' => $message,
            ]
        ));
    }
}
