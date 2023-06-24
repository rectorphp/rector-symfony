<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Twig134\Rector\Return_\SimpleFunctionAndFilterRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(SimpleFunctionAndFilterRector::class);
};
