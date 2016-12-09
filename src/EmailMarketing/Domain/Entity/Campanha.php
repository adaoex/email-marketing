<?php
declare(strict_types = 1);
namespace EmailMarketing\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Campanha
{

    private $id;
    
    private $nome;
    
    private $assunto;
    
    private $template;
    
    private $tags;
    
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->getCampanhas()->add($this);
            $this->tags->add($tag);
        }
        return $this;
    }
    
    public function removeTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->getCampanhas()->removeEelement($this);
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

    public function getTemplate()
    {
        return $this->template;
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

    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
        return $this;
    }

}
