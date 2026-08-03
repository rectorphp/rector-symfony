<?php

namespace Rector\Symfony\Tests\Configs\Rector\MethodCall\EnableValidationAttributesRector\Fixture;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var ContainerBuilder $container */
$container->loadFromExtension('twig', [
    'validation' => [
        'enable_attributes' => false,
    ],
]);
