<?php

namespace EmailMarketing\Application\Form\Factory;

use Doctrine\ORM\EntityManager;
use EmailMarketing\Application\Form\LoginForm;
use EmailMarketing\Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;

class LoginFormFactory
{

    public function __invoke(ContainerInterface $container) : LoginForm
    {
        $form = new LoginForm();
        #$form->setHydrator(new \Zend\Hydrator\ClassMethods());
        #$form->setObject(new Object());
        $form->setInputFilter(new LoginInputFilter());
        return $form;
    }

}
