<?php

namespace EmailMarketing\Application\Action\Campanha;

use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Domain\Persistence\CampanhaRepositoryInterface;
use EmailMarketing\Domain\Service\CampanhaEmailSenderInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class CampanhaSenderPageAction
{

    /**
     * @var CampanhaRepositoryInterface
     */
    private $repository;

    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var CampanhaForm
     */
    private $form;

    /**
     * @var CampanhaEmailSenderInterface
     */
    private $emailSender;

    public function __construct(
            CampanhaRepositoryInterface $repository,
            Template\TemplateRendererInterface $template,
            RouterInterface $router,
            CampanhaForm $form,
            CampanhaEmailSenderInterface $emailSender
    ) {
        $this->emailSender = $emailSender;
        $this->form = $form;
        $this->router = $router;
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next = null
    ) {
        $flash = $request->getAttribute('flash');
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
               
        $this->form->bind($entity);
        
        if ( $request->getMethod() == "POST" ){
            $this->emailSender->setCampanha($entity);
            $this->emailSender->send();
            $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Campanha enviada com sucesso");
            $uri = $this->router->generateUri('campanha.list');
            return new RedirectResponse( $uri );
        }
        
        return new HtmlResponse(
            $this->template->render('app::campanha/sender', [
                'form' => $this->form,
            ])
        );

    }
}
