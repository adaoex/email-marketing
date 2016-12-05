<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Application\Form\ContatoForm;
use EmailMarketing\Application\InputFilter\ContatoInputFilter;
use EmailMarketing\Domain\Entity\Contato;
use Interop\Container\ContainerInterface;

class ContatoFormFactory
{

    public function __invoke(ContainerInterface $container) : ContatoForm
    {
        $entityManager = $container->get(EntityManager::class);
        $form = new ContatoForm();
        $form->setHydrator(new DoctrineHydrator($entityManager))
                ->setAttribute('method', 'post')
                ->setObject(new Contato());
        $form->setInputFilter(new ContatoInputFilter());
        $form->setObjectManager($entityManager);
        $form->init();
        
        return $form;
    }

}
