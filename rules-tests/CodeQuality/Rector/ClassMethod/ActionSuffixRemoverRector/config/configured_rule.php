<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ActionSuffixRemoverRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ActionSuffixRemoverRector::class);
};
