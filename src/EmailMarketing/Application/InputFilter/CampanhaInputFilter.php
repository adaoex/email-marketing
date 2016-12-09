<?php

namespace EmailMarketing\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class CampanhaInputFilter extends InputFilter
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
            'name' => 'assunto',
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
            'name' => 'template',
            'required' => true,
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

    }

}
