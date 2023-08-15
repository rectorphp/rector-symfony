<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony30\Rector\MethodCall\ReadOnlyOptionToAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ReadOnlyOptionToAttributeRector::class);
};
