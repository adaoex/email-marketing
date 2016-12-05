<?php
declare (strict_types = 1);
namespace EmailMarketing\Domain\Service;

interface AuthInterface
{
    public function authenticate(string $email, string $password) : bool;
    
    public function isAuth() : bool;
    
    public function getUser();
    
    public function destroy();

}
