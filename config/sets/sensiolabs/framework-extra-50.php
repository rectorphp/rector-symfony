<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TemplateAnnotationToThisRenderRector::class);
};
