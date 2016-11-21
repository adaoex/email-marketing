<?php

namespace EmailMarketing\Domain\Entity;

class User
{
    
    private $id;
    
    private $nome;
    
    private $email;
    
    private $password;
    
    private $plainPassword;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    
    public function generatePassword()
    {
        $password = $this->getPlainPassword() 
                ? $this->getPlainPassword() 
                : uniqid();
        $this->setPassword(password_hash($password, PASSWORD_BCRYPT));
    }
    
}
