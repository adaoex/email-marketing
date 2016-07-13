<?php

namespace EmailMarketing\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Cliente
{
    
    private $id;
    
    private $nome;
    
    private $email;

    private $cpf;
    
    private $enderecos;

    public function __construct()
    {
        $this->enderecos = new ArrayCollection();
    }
    
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

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEnderecos()
    {
        return $this->enderecos;
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

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function setEnderecos($enderecos)
    {
        $this->enderecos = $enderecos;
        return $this;
    }
    
    public function addEndereco(Endereco $endereco)
    {
        $this->enderecos->add( $endereco );
        return $this;
    }
    
    public function removeEndereco(Endereco $endereco)
    {
        $this->enderecos->remove( $endereco );
        return $this;
    }
    
}
