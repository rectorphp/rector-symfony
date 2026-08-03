<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\FuncCall\ContainerInterfaceServiceToServiceContainerRector\Fixture;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service('AnotherValue');
