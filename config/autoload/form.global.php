<?php

use EmailMarketing\Infrastructure\View\HelperPluginManagerFactory;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View\HelperPluginManager;

$forms = [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
            HelperPluginManager::class => HelperPluginManagerFactory::class
        ],
        'aliases' => [
        ],
    ],
    'view_helpers' => [
        'invokables' => [
        ],
        'factories' => [
        ],
        'aliases' => [
        ],
    ]
];

$configProviderForm = (new ConfigProvider())->__invoke();

return ArrayUtils::merge($configProviderForm, $forms);
