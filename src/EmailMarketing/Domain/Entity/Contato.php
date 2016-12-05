<?php

namespace EmailMarketing\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Contato
{

    private $id;
    private $nome;
    private $email;
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTags(\Doctrine\Common\Collections\Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->getContatos()->add($this);
            $this->tags->add($tag);
        }
        return $this;
    }
    
    public function removeTags(\Doctrine\Common\Collections\Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->getContatos()->removeEelement($this);
            $this->tags->removeElement($tag);
        }
        return $this;
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

}
