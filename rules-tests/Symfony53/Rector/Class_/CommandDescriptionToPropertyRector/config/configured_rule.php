<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony53\Rector\Class_\CommandDescriptionToPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CommandDescriptionToPropertyRector::class);
};
