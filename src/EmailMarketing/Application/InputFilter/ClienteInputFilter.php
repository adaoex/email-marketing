<?php

namespace EmailMarketing\Application\InputFilter;

use EmailMarketing\Application\InputFilter\Validator\CPFValidator;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class ClienteInputFilter extends InputFilter
{

    public function __construct()
    {
        $this->add([
            'name' => 'nome',
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
        ]);

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
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
        ]);

        $this->add([
            'name' => 'cpf',
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
                ],
                ['name' => CPFValidator::class]
            ]
        ]);
    }

}
