<?php

namespace EmailMarketing\Infrastructure\View\Twig;

use Twig_Environment as TwigEnviroment;
use Zend\Expressive\Twig\TwigRenderer as ZendTwigRenderer;

class TwigRenderer extends ZendTwigRenderer
{

    /**
     * @return TwigEnviroment
     */
    public function getTemplate()
    {
        return $this->template;
    }

}
