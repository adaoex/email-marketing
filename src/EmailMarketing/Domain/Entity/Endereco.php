<?php
namespace EmailMarketing\Domain\Entity;

class Endereco
{
    
    private $id;
    
    private $cep;
    
    private $logradouro;
    
    private $cidade;
    
    private $bairro;
    
    private $estado;
    
    private $cliente;
    
    public function getId()
    {
        return $this->id;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }


    
}
