<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

// parent set config that misses one nested config import
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/incomplete_set/first_rule.php');
};
