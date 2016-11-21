<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Element;
use Zend\Form\Form;


class LoginForm extends Form
{

    public function __construct()
    {
        parent::__construct('login');

        $this->add(array(
            'type' => Element\Csrf::class,
            'name' => 'csrf',
        ));
        
        $this->add([
            'name' => 'email',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email',
                'type' => 'email',
            ]
        ]);
        
        $this->add([
            'name' => 'password',
            'type' => Element\Password::class,
            'options' => [
                'label' => 'Senha'
            ],
            'attributes' => [
                'id' => 'password'
            ]
        ]);
        
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
