<?php

namespace Rector\Symfony\Tests\Set\Symfony32\Source;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class TabCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
    }
}
