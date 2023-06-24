<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Removing\Rector\ClassMethod\ArgumentRemoverRector;
use Rector\Removing\ValueObject\ArgumentRemover;
use Rector\Symfony\Symfony34\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector;
use Rector\Symfony\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(ArgumentRemoverRector::class, [
        new ArgumentRemover(
            'Symfony\Component\Yaml\Yaml',
            'parse',
            2,
            ['Symfony\Component\Yaml\Yaml::PARSE_KEYS_AS_STRINGS']
        ),
    ]);

    $rectorConfig->rules([
        MergeMethodAnnotationToRouteAnnotationRector::class,
        ReplaceSensioRouteAnnotationWithSymfonyRector::class,
    ]);
};
