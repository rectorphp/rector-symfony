<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\Class_\CommandDescriptionToPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');
    $rectorConfig->rule(CommandDescriptionToPropertyRector::class);
};
