<?php
namespace EmailMarketing\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("enderecos")
 */
class Endereco
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $cep;
    
    /**
     * @ORM\Column(type="string")
     */
    private $logradouro;
    
    /**
     * @ORM\Column(type="string")
     */
    private $cidade;
    
    /**
     * @ORM\Column(type="string")
     */
    private $estado;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="enderecos")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
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
