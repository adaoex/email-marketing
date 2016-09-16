<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Element;
use Zend\Form\Form;


class ClienteForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('cliente');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setAttribute('method', 'post');

        $clienteFieldset = new ClienteFieldset($objectManager);
        $clienteFieldset->setUseAsBaseFieldset(true);
        $this->add( $clienteFieldset );

        $this->add(array(
            'type' => Element\Csrf::class,
            'name' => 'csrf',
        ));
        
        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
            'options' => [
                'label' => 'Enviar'
            ],
            'attributes' => [
                'id' => 'submit'
            ]
        ]);
    }

}
