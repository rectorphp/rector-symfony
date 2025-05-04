<?php

declare(strict_types=1);

use PHPStan\Type\IterableType;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector;
use Rector\Visibility\ValueObject\ChangeMethodVisibility;
use Rector\ValueObject\Visibility;
use Rector\Transform\Rector\ClassMethod\WrapReturnRector;
use Rector\Transform\ValueObject\WrapReturn;
use PHPStan\Type\MixedType;
use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        new MethodCallRename('Symfony\Component\Form\AbstractTypeExtension', 'getExtendedType', 'getExtendedTypes'),
    ]);

    $iterableType = new IterableType(new MixedType(), new MixedType());

    $rectorConfig->ruleWithConfiguration(
        AddReturnTypeDeclarationRector::class,
        [
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedTypes',
                $iterableType
            ),
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        ChangeMethodVisibilityRector::class,
        [new ChangeMethodVisibility(
            'Symfony\Component\Form\AbstractTypeExtension',
            'getExtendedTypes',
            Visibility::STATIC
        ),
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        WrapReturnRector::class,
        [
            new WrapReturn(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedTypes',
                true
            ),
        ]
    );
};
