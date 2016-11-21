<?php
declare (strict_types = 1);
namespace EmailMarketing\Domain\Service;

use EmailMarketing\Domain\Entity\User;

interface AuthInterface
{
    public function authenticate(string $email, string $password) : bool;
    
    public function isAuth() : bool;
    
    public function getUser(): User;
    
    public function destroy();

}
