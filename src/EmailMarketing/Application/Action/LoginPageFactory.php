<?php

namespace EmailMarketing\Application\Action;

use EmailMarketing\Application\Form\LoginForm;
use EmailMarketing\Domain\Service\AuthInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->get(TemplateRendererInterface::class);
        $form = $container->get(LoginForm::class);
        $authService = $container->get(AuthInterface::class);
        return new LoginPageAction($router, $template, $form, $authService);
    }
}
