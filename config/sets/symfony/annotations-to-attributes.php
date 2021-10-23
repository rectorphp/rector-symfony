<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

// @see https://symfony.com/blog/new-in-symfony-5-2-constraints-as-php-attributes
return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::SYMFONY_52_VALIDATOR_ATTRIBUTES);

    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline([
                // @see https://symfony.com/blog/new-in-symfony-5-2-php-8-attributes
                new AnnotationToAttribute('required', 'Symfony\Contracts\Service\Attribute\Required'),
                new AnnotationToAttribute('Symfony\Component\Routing\Annotation\Route'),
            ]),
        ]]);
};
