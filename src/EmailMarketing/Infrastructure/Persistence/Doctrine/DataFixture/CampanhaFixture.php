<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\Campanha;
use Faker\Factory;

class CampanhaFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        foreach (range(1, 10) as $key => $value){
            $campanha = new Campanha();
            $campanha->setNome( $faker->country )
                    ->setAssunto( "%recipient.full_name%, ". $faker->sentence(2))
                ->setTemplate( "<h2>Faker com Mailgun</h2>"
                        . "<p>%recipient.full_name%</p>"
                        . "<p>{$faker->paragraph(2)}</p>"
                        . "<p><a href='http://www.adao.eti.br' >Adao Gonçalves</a></p>" );
            $manager->persist($campanha);
            $this->setReference("campanha-$key", $campanha);
        }
        $manager->flush();
    }

    /* prioridade crescente */
    public function getOrder(): int
    {
        return 100;
    }

}
