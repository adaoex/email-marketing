<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\Tag;
use Faker\Factory;

class TagFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        foreach (range(1, 100) as $value){
            $entity = new Tag();
            $entity->setNome( $faker->city );
            $this->addContatos($entity);
            $this->addCampanhas($entity);
            $manager->persist($entity);
        }
        $manager->flush();
    }

    public function addContatos(Tag $tag)
    {
        $numCustumers = rand(1, 5);
        foreach (range(1, $numCustumers) as $value) {
            $index = rand(0, 99);
            $contato = $this->getReference("contato-$index");
            if ( $tag->getContatos()->exists(function($key, $item) use ($contato){
                return $contato->getId() == $item->getId();    
            }))
            {
                $index = rand(0, 99);
                $contato = $this->getReference("contato-$index");    
            }
            /*if ( $tag->getContatos()->contains($contato) ){
                $tag->addContato($contato);
            }*/
            $tag->getContatos()->add($contato);
        }
    }
    
    public function addCampanhas(Tag $tag)
    {
        $numCustumers = rand(1, 5);
        foreach (range(1, $numCustumers) as $value) {
            $index = rand(0, 99);
            $campanha = $this->getReference("campanha-$index");
            if ( $tag->getCampanhas()->exists(function($key, $item) use ($campanha){
                return $campanha->getId() == $item->getId();    
            }))
            {
                $index = rand(0, 99);
                $campanha = $this->getReference("campanha-$index");    
            }
            
            $tag->getCampanhas()->add($campanha);
        }
    }
    
    /* prioridade crescente */
    public function getOrder(): int
    {
        return 200;
    }

}
