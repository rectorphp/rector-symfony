<?php

declare(strict_types=1);

use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony53\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;

# https://github.com/symfony/symfony/blob/5.4/UPGRADE-5.3.md

return static function (RectorConfig $rectorConfig): void {
    // $rectorConfig->sets([SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES]);

    $rectorConfig->import(__DIR__ . '/symfony53/symfony53-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony53/symfony53-console.php');
    $rectorConfig->import(__DIR__ . '/symfony53/symfony53-http-kernel.php');
    $rectorConfig->import(__DIR__ . '/symfony53/symfony53-security-core.php');

    $rectorConfig->ruleWithConfiguration(AddReturnTypeDeclarationRector::class, [
        new AddReturnTypeDeclaration(
            'Symfony\Component\Mailer\Transport\AbstractTransportFactory',
            'getEndpoint',
            new StringType(),
        ),
    ]);

    $rectorConfig->ruleWithConfiguration(AddParamTypeDeclarationRector::class, [
        // @see https://github.com/symfony/symfony/commit/ce77be2507631cd12e4ca37510dab37f4c2b759a
        new AddParamTypeDeclaration(
            'Symfony\Component\Form\DataMapperInterface',
            'mapFormsToData',
            0,
            new ObjectType(Traversable::class)
        ),
        // @see https://github.com/symfony/symfony/commit/ce77be2507631cd12e4ca37510dab37f4c2b759a
        new AddParamTypeDeclaration(
            'Symfony\Component\Form\DataMapperInterface',
            'mapDataToForms',
            1,
            new ObjectType(Traversable::class)
        ),
    ]);

    $rectorConfig->rules([KernelTestCaseContainerPropertyDeprecationRector::class]);
};
