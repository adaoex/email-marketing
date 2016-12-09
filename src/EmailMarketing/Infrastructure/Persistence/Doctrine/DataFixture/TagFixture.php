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
        $indexCustumers = array_rand(range(0,3), rand(2, 4));
        foreach ($indexCustumers as $value) {
            $contato = $this->getReference("contato-$value");
            $tag->getContatos()->add($contato);
        }
    }
    
    public function addCampanhas(Tag $tag)
    {
        $indexCampanhas = array_rand(range(0,9), rand(2, 4));
        foreach ($indexCampanhas as $value) {
            $campanha = $this->getReference("campanha-$value");
            if ( $campanha->getTags()->count() < 2 ){
                $campanha->getTags()->add($tag);
                $tag->getCampanhas()->add($campanha);
            }
        }
    }
    
    /* prioridade crescente */
    public function getOrder(): int
    {
        return 200;
    }

}
