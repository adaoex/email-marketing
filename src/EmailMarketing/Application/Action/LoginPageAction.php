<?php

namespace EmailMarketing\Application\Action;

use EmailMarketing\Application\Form\LoginForm;
use EmailMarketing\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class LoginPageAction
{
    private $router;

    private $template;
    
    private $form;
    
    private $authService;

    public function __construct(
            Router\RouterInterface $router, 
            Template\TemplateRendererInterface $template,
            LoginForm $form,
            AuthInterface $authService
    ) {
        $this->router   = $router;
        $this->template = $template;
        $this->form = $form;
        $this->authService = $authService;
    }

    public function __invoke(
            ServerRequestInterface $request, 
            ResponseInterface $response, 
            callable $next = null
    ) {
        $renderParams = ['form' => $this->form];
        
        if($request->getMethod() == 'POST'){
            $data = $request->getParsedBody();
            $this->form->setData($data);
            if ( $this->form->isValid() ){
                $user = $this->form->getData();
                if ( $this->authService->authenticate($user['email'], $user['password']) ){
                    $uri = $this->router->generateUri('contato.list');
                    return new RedirectResponse($uri);
                }
                $renderParams['message'] = "Login e/ou senha inválidos";
                $renderParams['messageType'] = "error";
            }
        }

        return new HtmlResponse($this->template->render('app::login', $renderParams));
    }
}
