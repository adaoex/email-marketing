<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\User;

class UserFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        $entity = new User();
        $entity->setNome( 'Admin' )
            ->setEmail( 'adao@adao.eti.br' )
            ->setPlainPassword( '12345' );
        $manager->persist($entity);
        
        foreach (range(1, 100) as $value){
            $entity = new User();
            $entity->setNome( $faker->name . ' ' . $faker->lastName )
                ->setEmail( $faker->email )
                ->setPlainPassword( '12345' );
            $manager->persist($entity);
        }
        $manager->flush();
    }
}
