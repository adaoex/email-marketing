<?php

namespace EmailMarketing\Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use EmailMarketing\Domain\Entity\Endereco;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\NotEmpty;

class EnderecoFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('endereco');

        $this->setHydrator(new DoctrineHydrator($objectManager) )
                ->setObject(new Endereco());

        $this->add([
            'name' => 'logradouro',
            'type' => Text::class,
            'options' => [
                'label' => 'Logradouro'
            ],
            'attributes' => [
                'id' => 'logradouro',
                'class' => 'form-control',
            ]
        ]);

        $this->add([
            'name' => 'bairro',
            'type' => Text::class,
            'options' => [
                'label' => 'Bairro'
            ],
            'attributes' => [
                'id' => 'bairro',
                'class' => 'form-control',
            ]
        ]);

        $this->add([
            'name' => 'cidade',
            'type' => Text::class,
            'options' => [
                'label' => 'Cidade'
            ],
            'attributes' => [
                'id' => 'cidade',
                'class' => 'form-control',
            ]
        ]);
        
        $this->add([
            'name' => 'cep',
            'type' => Text::class,
            'options' => [
                'label' => 'CEP'
            ],
            'attributes' => [
                'id' => 'cep',
                'class' => 'form-control',
            ]
        ]);

        $this->add([
            'type' => Select::class,
            'name' => 'estado',
            'options' => [
                'label' => 'Selecione o Estado',
                'empty_option' => 'Selecione um Estado',
                'value_options' => $this->getEstados(),
            ],
            'attributes' => [
                'class' => 'form-control',
            ]
        ]);
    }

    private function getEstados()
    {
        return [
            "AC" => "Acre"
            , "AL" => "Alagoas"
            , "AP" => "Amapá"
            , "AM" => "Amazonas"
            , "BA" => "Bahia"
            , "CE" => "Ceará"
            , "DF" => "Distrito Federal"
            , "ES" => "Espírito Santo"
            , "GO" => "Goiás"
            , "MA" => "Maranhão"
            , "MT" => "Mato Grosso"
            , "MS" => "Mato Grosso do Sul"
            , "MG" => "Minas Gerais"
            , "PA" => "Pará"
            , "PB" => "Paraíba"
            , "PR" => "Paraná"
            , "PE" => "Pernambuco"
            , "PI" => "Piauí"
            , "RJ" => "Rio de Janeiro"
            , "RN" => "Rio Grande do Norte"
            , "RS" => "Rio Grande do Sul"
            , "RO" => "Rondônia"
            , "RR" => "Roraima"
            , "SC" => "Santa Catarina"
            , "SP" => "São Paulo"
            , "SE" => "Sergipe"
            , "TO" => "Tocantins"
        ];
    }

    public function getInputFilterSpecification()
    {
        return [
            'logradouro' => [
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
            'bairro' => [
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
            'cidade' => [
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
        ];
    }

}
