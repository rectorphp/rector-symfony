<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

// @see https://github.com/symfony/symfony/blob/7.0/UPGRADE-7.0.md
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony70/symfony70-dependency-injection.php');
    $rectorConfig->import(__DIR__ . '/symfony70/symfony70-serializer.php');
    $rectorConfig->import(__DIR__ . '/symfony70/symfony70-http-foundation.php');

    // the "@required" was dropped, use attribute instead
    $rectorConfig->ruleWithConfiguration(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute('required', 'Symfony\Contracts\Service\Attribute\Required'),
    ]);
};
