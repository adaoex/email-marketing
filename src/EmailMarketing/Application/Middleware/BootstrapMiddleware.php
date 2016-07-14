<?php

namespace EmailMarketing\Application\Middleware;

use EmailMarketing\Domain\Service\BootstrapInterface;
use EmailMarketing\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BootstrapMiddleware
{

    private $bootstrap;
    
    private $flashMessage;

    public function __construct(
            BootstrapInterface $bootstrapInterface, 
            FlashMessageInterface $flashMessage
    ) {
        $this->bootstrap = $bootstrapInterface;
        $this->flashMessage = $flashMessage;
    }

    public function __invoke(
            ServerRequestInterface $request, 
            ResponseInterface $response, 
            callable $next = null
    ) {
        $this->bootstrap->create();
        $request = $request->withAttribute('flash', $this->flashMessage);
        return $next($request, $response);
    }

}
