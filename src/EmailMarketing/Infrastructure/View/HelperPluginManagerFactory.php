<?php

namespace EmailMarketing\Infrastructure\View;

use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class HelperPluginManagerFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $viewHelpers = $config['view_helpers'];
        $pluginManager = new HelperPluginManager($container, $viewHelpers);
        $phpRenderer = new PhpRenderer();
        $phpRenderer->setHelperPluginManager($pluginManager);
        return $pluginManager;
    }

}
