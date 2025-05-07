<?php

declare(strict_types=1);

use PHPStan\Type\ArrayType;
use PHPStan\Type\MixedType;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;

// https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.0.md
// @see https://github.com/symfony/symfony/blob/6.1/.github/expected-missing-return-types.diff

return static function (RectorConfig $rectorConfig): void {
    $arrayType = new ArrayType(new MixedType(), new MixedType());

    $rectorConfig->ruleWithConfiguration(AddReturnTypeDeclarationRector::class, [
        new AddReturnTypeDeclaration(
            'Symfony\Component\EventDispatcher\EventSubscriberInterface',
            'getSubscribedEvents',
            $arrayType
        ),
    ]);
};
