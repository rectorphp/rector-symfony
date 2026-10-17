<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Routing\Rector\MethodCall\UrlGeneratorReferenceTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(UrlGeneratorReferenceTypeRector::class);
};
