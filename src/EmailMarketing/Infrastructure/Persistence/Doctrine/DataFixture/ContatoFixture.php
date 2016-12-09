<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\Contato;
use Faker\Factory;

class ContatoFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //$faker = Factory::create();
        
        foreach ( $this->getData() as $key => $value){
            $contato = new Contato();
            $contato->setNome( $value['nome'] )
                ->setEmail( $value['email'] );
            $manager->persist($contato);
            $this->setReference("contato-$key", $contato);
        }
        $manager->flush();
    }

    public function getData()
    {
        return [
            ['nome'=>'Adão 1', 'email'=>'adao@adao.eti.br'],
            ['nome'=>'Adão 2', 'email'=>'flexlabs@flexlabs.website'],
            ['nome'=>'Adão 3', 'email'=>'contato@flexlabs.website'],
            ['nome'=>'Adão 4', 'email'=>'adao.dba@gmail.com'],
        ];
    }
    
    /* prioridade crescente */
    public function getOrder(): int
    {
        return 100;
    }

}
