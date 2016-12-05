<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use EmailMarketing\Domain\Entity\Tag;
use Zend\Form\Element;
use Zend\Form\Form;

class CampanhaForm extends Form implements ObjectManagerAwareInterface
{
        
    private $objectManager;
    
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function __construct()
    {
        parent::__construct('Campanha');
    }
    
    public function init()
    {
        
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
            'name' => 'template',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Template'
            ],
            'attributes' => [
                'id' => 'template'
            ]
        ]);

        $this->add([
            'name' => 'tags',
            'type' => ObjectSelect::class,
            'attributes' => [
                'multiple' => 'multiple'
            ],
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class'   => Tag::class,
                'property'       => 'nome',
            ],
        ]);
        
    }

}
