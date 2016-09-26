<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\Contato;

class ContatoFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        foreach (range(1, 100) as $value){
            $contato = new Contato();
            $contato->setNome( $faker->name . ' ' . $faker->lastName )
                ->setEmail( $faker->email );
            $manager->persist($contato);
        }
        $manager->flush();
    }
}
