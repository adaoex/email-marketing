<?php

namespace EmailMarketing\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EmailMarketing\Domain\Entity\Cliente;
use EmailMarketing\Domain\Entity\Endereco;


class ClienteFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        foreach (range(1, 100) as $value){
            $cliente = new Cliente();
            $cliente->setNome( $faker->name . ' ' . $faker->lastName )
                    ->setCpf($faker->numerify('###.###.###-##'))
                    ->setEmail( $faker->email );
            
            $enderecos = new ArrayCollection();
            for($e = 1; $e <= rand(1, 5); $e++){
                $endereco = new Endereco();
                $endereco->setLogradouro($faker->streetAddress)
                        ->setBairro($faker->secondaryAddress)
                        ->setCep($faker->postcode)
                        ->setCidade($faker->city)
                        ->setEstado($faker->stateAbbr)
                        ->setCliente($cliente);
                $enderecos->add($endereco);
            }
            $cliente->addEnderecos($enderecos);
            
            $manager->persist($cliente);
        }
        
        $manager->flush();
    }

}
