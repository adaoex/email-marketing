<?php

namespace EmailMarketing\Application\Form;

use Zend\Form\Element\Hidden;

class HttpMethodElement extends Hidden
{
    public function __construct($value, $options = array())
    {
        parent::__construct('_method', $options);
        $this->setValue($value);
    }
}
