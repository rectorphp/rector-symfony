<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

class SkipAddCompileDefaultValue
{
    public function run(): void
    {
        $container = new ContainerBuilder();
        $container->compile();
    }
}
