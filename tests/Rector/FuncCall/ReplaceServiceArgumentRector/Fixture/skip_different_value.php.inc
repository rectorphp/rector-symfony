<?php

namespace Rector\Symfony\Tests\Rector\FuncCall\ReplaceServiceArgumentRector\Fixture;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service('AnotherValue');
