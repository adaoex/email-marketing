<?php

namespace EmailMarketing\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;

class TagInputFilter extends InputFilter
{

    public function __construct()
    {
        $this->add([
            'name' => 'nome',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

    }

}
