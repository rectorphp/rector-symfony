<?php

namespace Rector\Symfony\Tests\Set\Symfony32;

use Symfony\Component\DependencyInjection\ContainerBuilder;

final class CompilerPassDemo
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TabCompilerPass());
    }
}
