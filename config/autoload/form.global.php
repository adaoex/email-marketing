<?php

use EmailMarketing\Application\Form;
use EmailMarketing\Infrastructure\View\HelperPluginManagerFactory;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Helper\Service\IdentityFactory;
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
            Form\CampanhaForm::class => Form\Factory\CampanhaFormFactory::class,
        ],
        'aliases' => [
        ],
    ],
    'view_helpers' => [
        'invokables' => [
        ],
        'factories' => [
            'identity' => IdentityFactory::class,
        ],
        'aliases' => [
        ],
    ]
];

$configProviderForm = (new ConfigProvider())->__invoke();

return ArrayUtils::merge($configProviderForm, $forms);
