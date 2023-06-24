<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\MethodCall\ContainerBuilderCompileEnvArgumentRector\Fixture;

function containerBuilderCompilerEnvArgument()
{
    $containerBuilder = new \Symfony\Component\DependencyInjection\ContainerBuilder();
    $containerBuilder->compile();
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\MethodCall\ContainerBuilderCompileEnvArgumentRector\Fixture;

function containerBuilderCompilerEnvArgument()
{
    $containerBuilder = new \Symfony\Component\DependencyInjection\ContainerBuilder();
    $containerBuilder->compile(true);
}

?>
