<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        // @see https://github.com/symfony/symfony/pull/35828
        new MethodCallRename('Symfony\Component\Notifier\Bridge\Slack\Slack', 'channel', 'recipient'),
    ]);
};
