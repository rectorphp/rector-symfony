<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        AuthorizationCheckerIsGrantedExtractorRector::class,
    ]);
};
