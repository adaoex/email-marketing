<?php

namespace EmailMarketing\Application\Middleware;

use EmailMarketing\Domain\Service\BootstrapInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BootstrapMiddleware
{
    private $bootstrapInterface;
    
    public function __construct(BootstrapInterface $bootstrapInterface )
    {
        $this->bootstrapInterface = $bootstrapInterface;
    }
    
    public function __invoke( 
            ServerRequestInterface $request, 
            ResponseInterface $response, 
            callable $next = null 
    ) {
        $this->bootstrapInterface->create();
        return $next($request, $response);
    }
}
