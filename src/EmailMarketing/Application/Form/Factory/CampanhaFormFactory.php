<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Application\Form\CampanhaForm;
use EmailMarketing\Application\InputFilter\CampanhaInputFilter;
use EmailMarketing\Domain\Entity\Campanha;
use Interop\Container\ContainerInterface;

class CampanhaFormFactory
{

    public function __invoke(ContainerInterface $container) : CampanhaForm
    {
        $entityManager = $container->get(EntityManager::class);
        $form = new CampanhaForm();
        $form->setHydrator(new DoctrineHydrator($entityManager))
                ->setAttribute('method', 'post')
                ->setObject(new Campanha());
        $form->setInputFilter(new CampanhaInputFilter());
        $form->setObjectManager($entityManager);
        $form->init();
        
        return $form;
    }

}
