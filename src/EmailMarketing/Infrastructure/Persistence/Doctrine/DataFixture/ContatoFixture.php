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
        $faker = Factory::create();
        
        foreach (range(1, 100) as $key => $value){
            $contato = new Contato();
            $contato->setNome( $faker->name . ' ' . $faker->lastName )
                ->setEmail( $faker->email );
            $manager->persist($contato);
            $this->setReference("contato-$key", $contato);
        }
        $manager->flush();
    }

    /* prioridade crescente */
    public function getOrder(): int
    {
        return 100;
    }

}
