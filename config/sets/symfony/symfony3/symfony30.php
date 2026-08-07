<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

/**
 * @resource https://github.com/symfony/symfony/blob/3.4/UPGRADE-3.0.md
 */
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-bridge-monolog.php');
};
