<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Application\InputFilter\Validator\CPFValidator;
use EmailMarketing\Domain\Entity\Cliente;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Form\Element\Collection;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class ClienteFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('cliente');

        $this->setHydrator(new DoctrineHydrator($objectManager) )
                ->setObject(new Cliente());

        $this->add([
            'name' => 'nome',
            'type' => Text::class,
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'nome'
            ]
        ]);

        $this->add([
            'name' => 'email',
            'type' => Text::class,
            'options' => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email',
                'type' => 'email'
            ]
        ]);

        $this->add([
            'name' => 'cpf',
            'type' => Text::class,
            'options' => [
                'label' => 'CPF'
            ],
            'attributes' => [
                'id' => 'cpf',
            ]
        ]);

        $enderecosFieldset = new EnderecoFieldset($objectManager);
        $this->add([
            'type' => Collection::class,
            'name' => 'enderecos',
            'options' => [
                'label' => 'Endereços do Cliente',
                'count' => 1,
                'should_create_template' => true,
                'template_placeholder' => '__index__',
                'allow_add' => true,
                'target_element' => $enderecosFieldset
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'nome' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => NotEmpty::class,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => "Este campo é requerido"
                            ]
                        ]
                    ]
                ]
            ],
            'email' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => EmailAddress::class,
                        'options' => [
                            'messages' => [
                                EmailAddress::INVALID => "Este e-mail não é válido",
                            ]
                        ]
                    ]
                ]
            ],
            'cpf' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => CPFValidator::class,
                    ]
                ]
            ],
        ];
    }

}
