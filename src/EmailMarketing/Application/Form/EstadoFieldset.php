<?php

namespace EmailMarketing\Application\Form;

use EmailMarketing\Domain\Entity\Estado;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;

class EstadoFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct($options = array())
    {
        parent::__construct('estado', $options);

        $this->setHydrator(new ClassMethods(false))
                ->setObject(new Estado());

        $this->setLabel('Estado');

        $this->add(array(
            'name' => 'nome',
            'options' => array(
                'label' => 'Estado',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'sigla',
            'options' => array(
                'label' => 'Sigla',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return [
            'nome' => [
                'required' => true,
            ],
        ];
    }

}
