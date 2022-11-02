<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Symfony\Rector\Class_\CommandDescriptionToPropertyRector;

# https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.1.md

return static function (RectorConfig $rectorConfig): void {
    // @see https://symfony.com/blog/new-in-symfony-5-3-lazy-command-description
    $rectorConfig->rule(CommandDescriptionToPropertyRector::class);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // @see https://github.com/symfony/symfony/pull/43982
            'Symfony\Component\Serializer\Normalizer\ContextAwareDecoderInterface' => 'Symfony\Component\Serializer\Normalizer\DecoderInterface',
            'Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface' => 'Symfony\Component\Serializer\Normalizer\DenormalizerInterface',
            'Symfony\Component\Serializer\Normalizer\ContextAwareEncoderInterface' => 'Symfony\Component\Serializer\Normalizer\EncoderInterface',
            'Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface' => 'Symfony\Component\Serializer\Normalizer\NormalizerInterface',
        ],
    );
};
