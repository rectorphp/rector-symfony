<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony73\Rector\Class_\CommandHelpToAttributeRector;
use Rector\Symfony\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([CommandHelpToAttributeRector::class, InvokableCommandInputAttributeRector::class]);
};
