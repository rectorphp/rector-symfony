<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

if (class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator')) {
    return;
}

class ServicesConfigurator
{
    public function set(string $className): ServiceConfigurator
    {
    }
}
