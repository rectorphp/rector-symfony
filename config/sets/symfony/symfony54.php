<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

# https://github.com/symfony/symfony/blob/5.x/UPGRADE-5.4.md

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES);

    $services = $containerConfigurator->services();

    // @see https://symfony.com/blog/new-in-symfony-5-4-nested-validation-attributes
    // @see https://github.com/symfony/symfony/pull/41994
    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline([
                new AnnotationToAttribute('Symfony\Component\Validator\Constraints\All'),
                new AnnotationToAttribute('Symfony\Component\Validator\Constraints\Collection'),
                new AnnotationToAttribute('Symfony\Component\Validator\Constraints\AtLeastOneOf'),
                new AnnotationToAttribute('Symfony\Component\Validator\Constraints\Sequentially'),
            ]),
        ]]);
};
