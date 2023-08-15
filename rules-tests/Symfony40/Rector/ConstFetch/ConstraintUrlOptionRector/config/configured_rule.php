<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony40\Rector\ConstFetch\ConstraintUrlOptionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ConstraintUrlOptionRector::class);
};
