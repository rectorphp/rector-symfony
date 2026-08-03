<?php

namespace Rector\Symfony\Tests\Configs\Rector\MethodCall\EnableValidationAttributesRector\Fixture;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var ContainerBuilder $container */
$container->loadFromExtension('framework', [
    'validation' => [
        'enable_attributes' => true,
    ],
]);
