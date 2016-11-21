<?php

namespace EmailMarketing\Infrastructure\Service;

use EmailMarketing\Domain\Service\AuthInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use EmailMarketing\Domain\Entity\User;

class AuthService implements AuthInterface
{
    
    private $authenticationService;
    
    public function __construct(AuthenticationServiceInterface $authenticationService )
    {
        $this->authenticationService = $authenticationService;
    }
    
    public function authenticate(string $email, string $password) : bool
    {
        /** @var ValidatableAdapterInterface $adapter */
        $adapter = $this->authenticationService->getAdapter();
        $adapter->setIdentity($email);
        $adapter->setCredential($password);
        $result = $this->authenticationService->authenticate();
        return $result->isValid();
    }

    public function destroy()
    {
        $this->authenticationService->clearIdentity();
    }

    public function getUser() : User
    {
        $this->authenticationService->getIdentity();
    }

    public function isAuth(): bool
    {
        return $this->authenticationService->hasIdentity();
    }

}
