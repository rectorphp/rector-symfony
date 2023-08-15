<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

if (class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator')) {
    return;
}

class ContainerConfigurator
{
    public function services(): ServicesConfigurator
    {
        return new ServicesConfigurator();
    }
}
