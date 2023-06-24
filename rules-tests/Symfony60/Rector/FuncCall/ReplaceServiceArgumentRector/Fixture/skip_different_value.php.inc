<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\FuncCall\ReplaceServiceArgumentRector\Fixture;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service('AnotherValue');
