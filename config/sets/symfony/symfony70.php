<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Class_\RenameAttributeRector;
use Rector\Renaming\ValueObject\RenameAttribute;

// @see https://github.com/symfony/symfony/blob/7.0/UPGRADE-7.0.md
return static function (RectorConfig $rectorConfig): void {
    // @see https://github.com/symfony/symfony/blob/7.0/UPGRADE-7.0.md#dependencyinjection
    $rectorConfig->ruleWithConfiguration(RenameAttributeRector::class, [
        new RenameAttribute(
            'Symfony\Component\DependencyInjection\Attribute\MapDecorated',
            'Symfony\Component\DependencyInjection\Attribute\AutowireDecorated',
        ),
    ]);

    $rectorConfig->ruleWithConfiguration(\Rector\Renaming\Rector\Name\RenameClassRector::class, [
        // @see https://github.com/symfony/symfony/blob/7.0/UPGRADE-7.0.md#frameworkbundle
        'Symfony\Component\Serializer\Normalizer\ObjectNormalizer' => 'Symfony\Component\Serializer\Normalizer\NormalizerInterface',
        'Symfony\Component\Serializer\Normalizer\PropertyNormalizer' => 'Symfony\Component\Serializer\Normalizer\NormalizerInterface',

        // @see https://github.com/symfony/symfony/blob/7.0/UPGRADE-7.0.md#httpfoundation
        'Symfony\Component\HttpFoundation\RequestMatcher' => 'Symfony\Component\HttpFoundation\ChainRequestMatcher',
        'Symfony\Component\HttpFoundation\ExpressionRequestMatcher' => 'Symfony\Component\HttpFoundation\RequestMatcher\ExpressionRequestMatcher',
    ]);
};
