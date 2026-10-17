<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\HttpFoundation\Rector\New_\CookieConstructorDefaultsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CookieConstructorDefaultsRector::class);
};
