<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\HttpFoundation\Rector\New_\CookieSameSiteConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CookieSameSiteConstantRector::class);
};
