<?php
declare(strict_types = 1);
namespace EmailMarketing\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{

    private $id;
    
    private $nome;
    
    private $contatos;
    
    private $campanhas;

    public function __construct()
    {
        $this->contatos = new ArrayCollection();
        $this->campanhas = new ArrayCollection();
    }

    public function getContatos() : Collection
    {
        return $this->contatos;
    }

    public function addContatos(\Doctrine\Common\Collections\Collection $contatos)
    {
        foreach ($contatos as $contato) {
            $this->contatos->add($contato);
        }
    }
    
    public function removeContatos(\Doctrine\Common\Collections\Collection $contatos)
    {
        foreach ($contatos as $contato) {
            $this->contatos->removeElement($contato);
        }
    }
    
    public function getCampanhas()
    {
        return $this->campanhas;
    }
    
    public function addCampanhas(\Doctrine\Common\Collections\Collection $campnhas)
    {
        foreach ($campnhas as $campnha) {
            $this->campanhas->add($campnha);
        }
    }
    
    public function removeCampanhas(\Doctrine\Common\Collections\Collection $campnhas)
    {
        foreach ($campnhas as $campnha) {
            $this->campanhas->removeElement($campnha);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
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

}
