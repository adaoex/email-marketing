<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Application\InputFilter\TagInputFilter;
use EmailMarketing\Domain\Entity\Tag;
use Zend\Form\Element;
use Zend\Form\Form;

class TagForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('tag');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setAttribute('method', 'post')
                ->setObject(new Tag());

        $this->setInputFilter(new TagInputFilter());

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

    }
}
