<?php

declare(strict_types=1);

use PHPStan\Type\MixedType;
use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        new MethodCallRename('Symfony\Component\Form\AbstractTypeExtension', 'getExtendedType', 'getExtendedTypes'),
    ]);

    $iterableType = new \PHPStan\Type\IterableType(new MixedType(), new MixedType());

    $rectorConfig->ruleWithConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector::class,
        [
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedTypes',
                $iterableType
            ),
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        \Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector::class,
        [new \Rector\Visibility\ValueObject\ChangeMethodVisibility(
            'Symfony\Component\Form\AbstractTypeExtension',
            'getExtendedTypes',
            \Rector\ValueObject\Visibility::STATIC
        ),
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        \Rector\Transform\Rector\ClassMethod\WrapReturnRector::class,
        [
            new \Rector\Transform\ValueObject\WrapReturn(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedTypes',
                true
            ),
        ]
    );
};
