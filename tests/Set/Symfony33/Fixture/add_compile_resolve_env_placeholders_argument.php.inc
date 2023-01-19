<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddCompileResolveEnvPlaceholderArgument
{
    public function run(): void
    {
        $container = new ContainerBuilder();
        $container->compile();
    }
}

?>
-----
<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddCompileResolveEnvPlaceholderArgument
{
    public function run(): void
    {
        $container = new ContainerBuilder();
        $container->compile(false);
    }
}

?>
