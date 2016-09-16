<?php

namespace EmailMarketing\Domain\Entity;

class Estado
{

    private $id;
    
    private $nome;
    
    private $sigla;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSigla()
    {
        return $this->sigla;
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

    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
        return $this;
    }

}
