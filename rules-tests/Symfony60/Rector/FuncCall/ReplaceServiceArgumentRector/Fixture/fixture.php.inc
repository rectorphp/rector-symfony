<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\FuncCall\ReplaceServiceArgumentRector\Fixture;

use Psr\Container\ContainerInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service(ContainerInterface::class);

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\FuncCall\ReplaceServiceArgumentRector\Fixture;

use Psr\Container\ContainerInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service('service_container');

?>
