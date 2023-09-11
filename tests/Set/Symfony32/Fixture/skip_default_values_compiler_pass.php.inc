<?php

namespace Rector\Symfony\Tests\Set\Symfony32\Fixture;

use Rector\Symfony\Tests\Set\Symfony32\Source\TabCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class CompilerPassDemo
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TabCompilerPass());
    }
}
