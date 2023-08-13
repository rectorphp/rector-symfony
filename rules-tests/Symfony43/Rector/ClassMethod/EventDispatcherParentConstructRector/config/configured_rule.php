<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony43\Rector\ClassMethod\EventDispatcherParentConstructRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(EventDispatcherParentConstructRector::class);
};
