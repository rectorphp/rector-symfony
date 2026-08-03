<?php

namespace Rector\Symfony\Tests\Configs\Rector\MethodCall\EnableValidationAttributesRector\Fixture;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var ContainerBuilder $container */
$container->loadFromExtension('framework', [
    'secret' => '%secret_key%',
    'form' => null,
    'validation' => [
        'enable_attributes' => false,
    ],
]);

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\MethodCall\EnableValidationAttributesRector\Fixture;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var ContainerBuilder $container */
$container->loadFromExtension('framework', [
    'secret' => '%secret_key%',
    'form' => null,
    'validation' => [
        'enable_attributes' => true,
    ],
]);

?>
