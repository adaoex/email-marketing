<?php

use EmailMarketing\Application\Form;
use EmailMarketing\Infrastructure\View\HelperPluginManagerFactory;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View\HelperPluginManager;

$forms = [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
            HelperPluginManager::class => HelperPluginManagerFactory::class,
            Form\ClienteForm::class => Form\Factory\ClienteFormFactory::class,
            Form\ContatoForm::class => Form\Factory\ContatoFormFactory::class,
            Form\LoginForm::class => Form\Factory\LoginFormFactory::class,
            Form\TagForm::class => Form\Factory\TagFormFactory::class,
        ],
        'aliases' => [
        ],
    ],
    'view_helpers' => [
        'invokables' => [
        ],
        'factories' => [
            'identity' => \Zend\View\Helper\Service\IdentityFactory::class,
        ],
        'aliases' => [
        ],
    ]
];

$configProviderForm = (new ConfigProvider())->__invoke();

return ArrayUtils::merge($configProviderForm, $forms);
