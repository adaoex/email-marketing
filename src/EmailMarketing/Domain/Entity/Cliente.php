<?php
declare(strict_types = 1);
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

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }
    
    public function addEnderecos(\Doctrine\Common\Collections\Collection $enderecos)
    {
        foreach ($enderecos as $endereco) {
            $endereco->setCliente($this);
            $this->enderecos->add( $endereco );
        }
        return $this;
    }
    
    public function removeEnderecos(\Doctrine\Common\Collections\Collection $enderecos)
    {
        foreach ($enderecos as $endereco) {
            $endereco->setCliente(null);
            $this->enderecos->removeElement( $endereco );
        }
        return $this;
    }
    
}
