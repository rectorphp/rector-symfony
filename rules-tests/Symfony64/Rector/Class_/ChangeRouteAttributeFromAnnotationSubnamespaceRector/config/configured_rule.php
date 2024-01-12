<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ChangeRouteAttributeFromAnnotationSubnamespaceRector::class);
};
