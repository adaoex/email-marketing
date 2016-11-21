<?php

namespace EmailMarketing\Application\Middleware;

use EmailMarketing\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddleware
{
    private $router;
    
    private $authService;
    
    public function __construct(
        RouterInterface $router,
        AuthInterface $authService
    ){
        $this->authService = $authService;
        $this->router = $router;
    }
    
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        if ( ! $this->authService->isAuth() ){
            $uri = $this->router->generateUri('auth.login');
            return new RedirectResponse($uri);
        }
        return $next($request, $response);
    }
    
}
