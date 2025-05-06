<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        RenameMethodRector::class,
        [
            // @see https://github.com/symfony/symfony/pull/47711
            new MethodCallRename('Symfony\Component\Mime\Email', 'attachPart', 'addPart'),
        ],
    );
};
