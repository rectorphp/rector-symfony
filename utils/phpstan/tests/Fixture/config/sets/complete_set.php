<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

// parent set config that imports every nested config
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/complete_set/first_rule.php');
    $rectorConfig->import(__DIR__ . '/complete_set/second_rule.php');
};
