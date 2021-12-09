<?php

declare(strict_types=1);

use PhpParser\Node\Scalar\String_;
use Rector\Symfony\Rector\FuncCall\ReplaceServiceArgumentRector;
use Rector\Symfony\ValueObject\ReplaceServiceArgument;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(ReplaceServiceArgumentRector::class)
        ->configure([
            new ReplaceServiceArgument('Psr\Container\ContainerInterface', new String_('service_container')),
        ]);
};
