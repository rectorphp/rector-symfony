<?php

declare(strict_types=1);

use Rector\Removing\Rector\ClassMethod\ArgumentRemoverRector;
use Rector\Removing\ValueObject\ArgumentRemover;
use Rector\Symfony\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(ArgumentRemoverRector::class)
        ->configure([
            new ArgumentRemover(
                'Symfony\Component\Yaml\Yaml',
                'parse',
                2,
                ['Symfony\Component\Yaml\Yaml::PARSE_KEYS_AS_STRINGS']
            ),
        ]);

    $services->set(MergeMethodAnnotationToRouteAnnotationRector::class);
};
