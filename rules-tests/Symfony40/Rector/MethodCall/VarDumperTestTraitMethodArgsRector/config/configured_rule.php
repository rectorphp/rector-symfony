<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony40\Rector\MethodCall\VarDumperTestTraitMethodArgsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(VarDumperTestTraitMethodArgsRector::class);
};
