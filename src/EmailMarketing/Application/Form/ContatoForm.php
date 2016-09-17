<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Application\InputFilter\ContatoInputFilter;
use EmailMarketing\Domain\Entity\Contato;
use Zend\Form\Element;
use Zend\Form\Form;

class ContatoForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('contato');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setAttribute('method', 'post')
                ->setObject(new Contato());

        $this->setInputFilter(new ContatoInputFilter());

        $this->add(array(
            'type' => Element\Csrf::class,
            'name' => 'csrf',
        ));
        
        $this->add([
            'name' => 'nome',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'nome'
            ]
        ]);

        $this->add([
            'name' => 'email',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email',
                'type' => 'email'
            ]
        ]);

    }
}
