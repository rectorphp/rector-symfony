<?php

declare(strict_types=1);

use PHPStan\Type\MixedType;
use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;

// @see https://github.com/symfony/symfony/blob/6.4/UPGRADE-6.4.md
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            'Symfony\Component\HttpKernel\UriSigner' => 'Symfony\Component\HttpFoundation\UriSigner',
            'Symfony\Component\HttpKernel\Debug\FileLinkFormatter' => 'Symfony\Component\ErrorHandler\ErrorRenderer\FileLinkFormatter',
        ],
    );

    $rectorConfig->import(__DIR__ . '/symfony64/symfony64-routing.php');
    $rectorConfig->import(__DIR__ . '/symfony64/symfony64-form.php');
};
